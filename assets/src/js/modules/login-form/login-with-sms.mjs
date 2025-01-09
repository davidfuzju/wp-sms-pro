import * as utils from './login-form-utils.mjs'
import otpInput from '../otp/otp-input.mjs'

export default {init, initRecaptcha}

var elems
var data
var initiationPromise

var isNewUser = false
const referralCodeLengthLimit = 12

function init(initialData) {
    if (typeof initiationPromise == 'undefined')
        initiationPromise = new Promise((resolve) => {
            elems = {...utils.elements}
            data = initialData

            addLoginWithSmsChoiceSection()
            addSecondLoginStep()
            addThirdLoginStep()

            resolve()
        })
    return initiationPromise
}

/// 登录页面，自动添加 sms login 按钮
function addLoginWithSmsChoiceSection() {
    const section = jQuery(`
            <div class="or-login-with-wp-sms-otp-section">
                <div class=or-separator>
                    <span class="line"></span>
                    <p>${data.l10n.or}</p>
                    <span class="line"></span>
                </div>
                <button class="login-with-wp-sms-otp wpsms-button" type="button">
                    <span class="icon dashicons dashicons-email-alt"></span>
                    ${data.l10n.login_button_text}
                </button>
            </div>
        `)
    section.insertAfter(elems.loginForm)

    const loginWithSmsButton = section.children('button.login-with-wp-sms-otp')

    loginWithSmsButton.on('click', () => utils.steps.slideToStep(1))

    elems = {
        ...elems,
        loginWithSmsButton,
    }
}

/**
 * SMS 登录的第二个页面，输入手机号 + 可能填写 Referral Code
 */
function addSecondLoginStep() {
    const secondSlide = jQuery(`
            <div class="login-form-step second-step">
                <h2 class="title">${data.l10n.login_with_sms_title}</h2>
                <h6>${data.l10n.login_with_sms_number_subtitle}</h6>
                <div class="input-box">       
                    <label for="phoneNumber">${data.l10n.phone_number_field_label}</label>
                    ${data.elements.mobile_field}
                </div>

                <div id="referralCodeBox" class="input-box" style="display: none;">
                    <label for="referralCode">${data.l10n.referral_code_field_label}</label>
                    <input type="text" id="referralCode" name="referralCode" />
                </div>

                <button class="request-otp-button wpsms-button" disabled>
                    <span class="spinner"></span>
                    <span>${data.l10n.request_otp_button_text}</span>
                </button>
                <div class=or-separator>
                    <span class="line"></span>
                    <p>${data.l10n.or}</p>
                    <span class="line"></span>
                </div>
                <a class="or-login-regularly">
                    <span class="icon dashicons dashicons-arrow-left-alt"></span>
                    ${data.l10n.login_with_email_text}
                </a>
            </div>
        `)

    // 添加此界面
    utils.steps.addRightHandStep(secondSlide)

    let intlTelInputInstance

    const loginWithEmailButton = secondSlide.children('.or-login-regularly')
    const requestCodeBtn = secondSlide.children('.request-otp-button')
    const referralCodeBox = secondSlide.find('#referralCodeBox').hide()

    // phoneNumber 输入框
    const phoneNumberField = jQuery('#phoneNumber').extend({
        getPhoneNumber() {
            // 如果启用了 intlTelInput 插件，则优先用它来获取带区号的号码
            if (intlTelInputInstance == null && typeof window.intlTelInput != 'undefined') {
                intlTelInputInstance = window.intlTelInput.getInstance(phoneNumberField.get(0))
            }

            if (intlTelInputInstance == null) {
                // 没有初始化插件，则自己做简单的空格/破折号清理
                return this.val().replace(/[-\s]/g, '')
            } else {
                if (intlTelInputInstance.isValidNumber()) {
                    return intlTelInputInstance.getNumber()
                } else {
                    return ''
                }
            }
        },
    })

    // referralCode 输入框
    const referralCodeField = jQuery('#referralCode').extend({
        getReferralCode() {
            return this.val().trim().substring(0, referralCodeLengthLimit)
        },
    })

    const cookieReferralCode = getCookieOrEmpty('refer_code')
    if (!empty(cookieReferralCode)) {
        referralCodeField.val(cookieReferralCode)
        elems.capturedReferralCode = cookieReferralCode
    }
    const cookieReferralUrl = getCookieOrEmpty('refer_url')
    if (!empty(cookieReferralUrl)) {
        elems.capturedReferralUrl = cookieReferralUrl
    }
    // ------------------------------------------------------------------------
    // 统一的锁定/解锁字段函数
    // ------------------------------------------------------------------------
    function resetCapturedReferralCode() {
        elems.capturedReferralCode = ''
    }

    function lockField($field, locked = true) {
        $field.prop('readonly', locked)
    }

    // 启用/禁用 requestCodeBtn
    function setRequestBtnEnabled(enabled) {
        if (enabled) {
            requestCodeBtn.prop('disabled', false)
        } else {
            requestCodeBtn.prop('disabled', true)
        }
    }

    function showReferralCodeBox() {
        if (!referralCodeBox.is(':visible')) {
            referralCodeBox.slideDown(200)
        }
    }

    function hideReferralCodeBox() {
        if (!referralCodeBox.is(':hidden')) {
            referralCodeBox.slideUp(200)
            referralCodeField.val('')
        }
    }

    // ------------------------------------------------------------------------
    // 事件绑定
    // ------------------------------------------------------------------------

    // 点击 "登录邮箱" 按钮 => 回到第一步
    loginWithEmailButton.on('click', (e) => utils.steps.slideToStep(0))

    // 回到第二步时 => focus 到 phoneNumber
    elems.stepsContainer.on('slide', (e, index, promise) => {
        if (index == 1)
            promise.then(() => {
                phoneNumberField.trigger('focus')
            })
    })

    // 用户回车 => 触发 requestCodeBtn
    phoneNumberField.on('keydown', (e) => {
        if (e.key === 'Enter') {
            requestCodeBtn.trigger('click')
        }
    })

    //////////////////////////////////////////////////////////////////////////
    // 核心逻辑1：监听 phoneNumber 输入
    //////////////////////////////////////////////////////////////////////////
    phoneNumberField.on('input', function () {
        // 1) 本地校验
        if (!__verifyPhoneNumber()) {
            // 只要输入框内值发生错误，就重置 referral code 暂存
            resetCapturedReferralCode()
            // 校验失败 => 隐藏 referralCodeBox, 按钮禁用
            hideReferralCodeBox()
            setRequestBtnEnabled(false)
            return
        }

        // 2) 校验成功 => 锁定 phoneNumber，显示按钮loading，发起 checkReferralCodeByPhone
        lockField(phoneNumberField, true)

        // 如果号码大致有效，则调用 Ajax
        requestCodeBtn.addClass('loading')
        checkReferralCodeByPhone(phoneNumberField.getPhoneNumber())
            .done((res) => {
                // 请求成功
                if (res.success) {
                    // 业务请求成功
                    if (res.data.has_referral_code) {
                        // 手机号有推荐码关联
                        hideReferralCodeBox()
                        setRequestBtnEnabled(true)
                    } else {
                        // 手机号无推荐码关联
                        showReferralCodeBox()
                        setRequestBtnEnabled(false)
                    }
                } else {
                    // 业务请求失败
                    utils.notices.removeAllNotices()
                    utils.notices.addErrorNotice(res.data?.message || 'Check referral code failed.')
                    hideReferralCodeBox()
                    setRequestBtnEnabled(false)
                }
            })
            .fail((jqXhr) => {
                // 请求失败
                utils.notices.removeAllNotices()
                utils.notices.addErrorNotice(jqXhr.responseJSON?.message || 'Server error')
                hideReferralCodeBox()
                setRequestBtnEnabled(false)
            })
            .always(() => {
                // 不管成功/失败 => 解锁 phoneNumber，取消按钮loading
                lockField(phoneNumberField, false)
                setTimeout(() => requestCodeBtn.removeClass('loading'), 500)
            })
    })

    //////////////////////////////////////////////////////////////////////////
    // 核心逻辑2：如果需要 Referral Code，则用户手动输入
    //////////////////////////////////////////////////////////////////////////
    // 当用户填写完 referral code 并按下“提交”/“回车”等操作时，我们去校验
    // 这里提供一个示例：用户敲回车即可校验，或你可以再加个小按钮
    referralCodeField.on('keydown', (e) => {
        e.key == 'Enter' && requestCodeBtn.trigger('click')
    })

    referralCodeField.on('input', function () {
        if (!__verifyReferralCode()) {
            setRequestBtnEnabled(false)
            return
        }

        lockField(phoneNumberField, true)
        lockField(referralCodeField, true)
        requestCodeBtn.addClass('loading')

        validateReferralCode(phoneNumberField.getPhoneNumber(), referralCodeField.getReferralCode())
            .done((res) => {
                /// 请求成功
                if (res.success) {
                    /// 业务请求成功
                    if (res.data.result) {
                        // 验证推荐码通过
                        elems.capturedReferralCode = referralCodeField.getReferralCode()

                        utils.notices.removeAllNotices()
                        utils.notices.addSuccessNotice(res.data?.message || 'Referral code valid')

                        setRequestBtnEnabled(true)
                    } else {
                        // 验证推荐码未通过
                        resetCapturedReferralCode()

                        utils.notices.removeAllNotices()
                        utils.notices.addErrorNotice(res.data?.message || 'Invalid referral code')

                        setRequestBtnEnabled(false)
                    }
                } else {
                    // 业务请求失败
                    resetCapturedReferralCode()

                    utils.notices.removeAllNotices()
                    utils.notices.addErrorNotice(res.data?.message || 'Invalid referral code')

                    setRequestBtnEnabled(false)
                }
            })
            .fail((jqXhr) => {
                /// 请求失败
                resetCapturedReferralCode()

                utils.notices.removeAllNotices()
                utils.notices.addErrorNotice(jqXhr.responseJSON?.message || 'Server error')

                setRequestBtnEnabled(false)
            })
            .always(() => {
                setTimeout(() => {
                    requestCodeBtn.removeClass('loading')
                    lockField(referralCodeField, false)
                    lockField(phoneNumberField, false)
                }, 500)
            })
    })

    //////////////////////////////////////////////////////////////////////////
    // 核心逻辑3：点击 “requestCodeBtn”
    //////////////////////////////////////////////////////////////////////////
    requestCodeBtn.on('click', (e) => {
        if (requestCodeBtn.hasClass('loading') || requestCodeBtn.prop('disabled')) return

        if (!verifyPhoneNumber()) return

        lockField(phoneNumberField, true)
        lockField(referralCodeField, true)
        requestCodeBtn.addClass('loading')

        requestCode(phoneNumberField.getPhoneNumber())
            .done((data) => {
                utils.notices.removeAllNotices()
                utils.notices.addSuccessNotice(data.message)
                utils.steps.slideToStep(2)

                isNewUser = data.is_new !== undefined && data.is_new
            })
            .fail((jqXhr) => {
                utils.notices.removeAllNotices()
                utils.notices.addErrorNotice(jqXhr.responseJSON.message)
                utils.notices.shakeElement(elems.stepsContainer)
            })
            .always(() => {
                if (typeof grecaptcha != 'undefined') grecaptcha.reset()
                setTimeout(() => {
                    requestCodeBtn.removeClass('loading')
                    lockField(referralCodeField, false)
                    lockField(phoneNumberField, false)
                }, 500)
            })
    })

    elems = {
        ...elems,
        secondSlide,
        loginWithEmailButton,
        requestCodeBtn,
        phoneNumberField,
        referralCodeField,
    }
}

/// sms 登录的第三个页面，输入 sms 验证码
function addThirdLoginStep() {
    const thirdSlide = jQuery(`
            <div class="login-form-step third-step">
                <h2 class="title">${data.l10n.login_with_sms_title}</h2>
                <h6>${data.l10n.login_with_sms_code_subtitle}</h6>
                <div class="otp-input login-otp">
                    <label>${data.l10n.login_with_sms_code_label}</label>
                    <input class="otp-digit-input" type="text" maxlength="6">
                </div>
                <button class="verify-sms-otp wpsms-button" type="button">
                    <span class="spinner"></span>
                    <span>${data.l10n.login_button_text}</span>
                </button>
                <div class="request-new-code">
                    <p>${data.l10n.request_new_code_text}</p>
                    <a>
                        <span class="icon dashicons dashicons-email-alt"></span>
                        ${data.l10n.request_new_code_link}
                    </a>
                </div>
            </div>
        `)

    utils.steps.addRightHandStep(thirdSlide)

    const otpContainer = new otpInput(thirdSlide.children('.otp-input.login-otp')).init()
    const verificationBtn = thirdSlide.children('.verify-sms-otp')
    const requestNewCodeBtn = thirdSlide.children('.request-new-code')

    elems.stepsContainer.on('slide', (e, index, promise) => {
        if (index == 2)
            promise.then(() => {
                elems.otpContainer.focusInput()
            })
    })
    otpContainer.addEventListener('submit', () => verificationBtn.trigger('click'))
    otpContainer.addEventListener('invalidInput', (e) => {
        utils.notices.removeAllNotices()
        utils.notices.addErrorNotice(data.l10n.please_fill_digits_notice)
        setTimeout(() => verificationBtn.removeClass('loading'), 500)
    })

    verificationBtn.on('click', (e) => {
        const code = elems.otpContainer.getCode()
        if (code == false) return

        if (verificationBtn.hasClass('loading')) return

        if (!verifyPhoneNumber()) return

        verificationBtn.addClass('loading')

        verifyCode(elems.phoneNumberField.getPhoneNumber(), code, elems.capturedReferralCode, elems.capturedReferralUrl)
            .done((data) => {
                utils.notices.removeAllNotices()
                utils.notices.addSuccessNotice(data.message)
                setTimeout(() => {
                    window.location.replace(data.redirect_to)
                }, 500)
            })
            .fail((jqXhr) => {
                utils.notices.removeAllNotices()
                utils.notices.addErrorNotice(jqXhr.responseJSON.message)
                utils.notices.shakeElement(elems.stepsContainer)
                elems.otpContainer.addErrorClassToInput()
                elems.otpContainer.focusInput()
            })
            .always(setTimeout(() => verificationBtn.removeClass('loading'), 500))
    })

    requestNewCodeBtn.on('click', () => {
        utils.steps.slideToStep(1).then(() => {
            elems.otpContainer.clean()
        })
    })

    elems = {
        ...elems,
        thirdSlide,
        otpContainer,
        verificationBtn,
        requestNewCodeBtn,
    }
}

/**
 * 获取 cookie key 名称对应的
 * @param {*} name
 * @returns
 */
function getCookieOrEmpty(name) {
    const nameEQ = name + '='
    const ca = document.cookie.split(';')
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i].trim()
        if (c.indexOf(nameEQ) === 0) {
            let cookieValue = decodeURIComponent(c.substring(nameEQ.length, c.length))
            return cookieValue || ''
        }
    }
    return ''
}

/**
 * 验证手机号， 实际上可以看到并没有什么本地验证，只是查了一下是否为空而已
 */
function verifyPhoneNumber() {
    if (!__verifyPhoneNumber()) {
        utils.notices.removeAllNotices()
        utils.notices.addErrorNotice(data.l10n.invalid_phone_number)
        utils.notices.shakeElement(elems.stepsContainer)

        return false
    }

    return true
}

/**
 * 验证手机号，但是不会触发界面效果
 * @returns
 */
function __verifyPhoneNumber() {
    return elems.phoneNumberField.getPhoneNumber() !== ''
}

/**
 * 验证推荐码
 */
function verifyReferralCode() {
    if (!__verifyReferralCode()) {
        utils.notices.removeAllNotices()
        utils.notices.addErrorNotice(data.l10n.invalid_referral_code)
        utils.notices.shakeElement(elems.stepsContainer)
        return false
    }

    return true
}

/**
 * 验证推荐码，但是不会触发界面效果
 * @returns
 */
function __verifyReferralCode() {
    return elems.referralCodeField.getReferralCode().length == referralCodeLengthLimit
}
/**
 * API 请求站点后端， 查询当前手机号和推荐码是否合法
 * @param {*} phoneNumber
 * @param {*} referralCode
 * @returns
 */
function validateReferralCode(phoneNumber, referralCode) {
    return jQuery.ajax({
        method: 'POST',
        url: ajaxurl,
        data: {
            action: 'validate_referral_code',
            phone_number: phoneNumber,
            referral_code: referralCode,
        },
    })
}

/**
 * API 请求站点后端，查询当前手机号对应的用户是否有 referral code
 * @param {*} phoneNumber
 */
function checkReferralCodeByPhone(phoneNumber) {
    return jQuery.ajax({
        method: 'POST',
        url: ajaxurl,
        data: {
            action: 'check_referral_code_by_phone',
            phone_number: phoneNumber,
        },
    })
}

/**
 * API 请求 SMS 验证码
 * @param {*} phoneNumber 手机号
 * @returns
 */
function requestCode(phoneNumber) {
    const endPoint = data.endPoints.request_otp
    const requestData = {
        phone_number: phoneNumber,
    }

    if (data.recaptcha.site_key && window.grecaptcha) {
        requestData.recaptcha_response = grecaptcha.getResponse()
    }

    return jQuery.ajax({
        method: endPoint.method,
        url: endPoint.url,
        data: requestData,
        headers: {
            [endPoint.nonce_header_key]: endPoint.nonce,
        },
    })
}

/**
 * API 验证 SMS 验证码
 * @param {*} phoneNumber 手机号
 * @param {*} code 验证码
 * @param {*} referralCode 推荐码
 * @param {*} referralUrl 推荐 url
 * @returns
 */
function verifyCode(phoneNumber, code, referralCode, referralUrl) {
    const endPoint = data.endPoints.login_with_otp
    return jQuery.ajax({
        method: endPoint.method,
        url: endPoint.url,
        data: {
            phone_number: phoneNumber,
            code: code,
            referral_code: referralCode,
            referral_url: referralUrl,
            is_new: isNewUser,
        },
        headers: {
            [endPoint.nonce_header_key]: endPoint.nonce,
        },
    })
}

function initRecaptcha() {
    const recaptcha = jQuery(`<div class="wp-sms-login-form-recaptcha"></div>`).insertBefore(elems.requestCodeBtn)
    data.recaptchaId = grecaptcha.render(recaptcha.get(0), {sitekey: data.recaptcha.site_key})
}
