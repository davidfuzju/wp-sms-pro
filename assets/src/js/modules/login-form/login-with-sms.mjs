import * as utils from "./login-form-utils.mjs"
import otpInput from "../otp/otp-input.mjs"

export default {init, initRecaptcha}

var elems
var data
var initiationPromise

var isNewUser = false;

function init(initialData) {
    if (typeof initiationPromise == 'undefined') initiationPromise = new Promise((resolve) => {
        elems = {...utils.elements}
        data = initialData

        addLoginWithSmsChoiceSection()
        addSecondLoginStep()
        addThirdLoginStep()

        resolve()
    })
    return initiationPromise
}

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
        loginWithSmsButton
    }
}

function addSecondLoginStep() {
    const secondSlide = jQuery(`
            <div class="login-form-step second-step">
                <h2 class="title">${data.l10n.login_with_sms_title}</h2>
                <h6>${data.l10n.login_with_sms_number_subtitle}</h6>
                <div class="input-box">       
                    <label for="phoneNumber">${data.l10n.phone_number_field_label}</label>
                    ${data.elements.mobile_field}
                </div>    
                <button class="request-otp-button wpsms-button">
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

    utils.steps.addRightHandStep(secondSlide)

    let intlTelInputInstance;
    const loginWithEmailButton = secondSlide.children(".or-login-regularly")
    const requestCodeBtn = secondSlide.children('.request-otp-button')
    const phoneNumberField = jQuery('#phoneNumber').extend({
        getPhoneNumber() {
            if (intlTelInputInstance == null && typeof window.intlTelInput != 'undefined') {
                intlTelInputInstance = window.intlTelInput.getInstance(phoneNumberField.get(0));
            }

            if (intlTelInputInstance == null) {
                return this.val().replace(/[-\s]/g, '');
            } else {
                if (intlTelInputInstance.isValidNumber()) {
                    return intlTelInputInstance.getNumber();
                } else {
                    return '';
                }
            }
        }
    })

    loginWithEmailButton.on('click', e => utils.steps.slideToStep(0))

    phoneNumberField.on('keydown', e => {
        e.key == 'Enter' && requestCodeBtn.trigger('click')
    })
    elems.stepsContainer.on('slide', (e, index, promise) => {
        if (index == 1) promise.then(() => {
            phoneNumberField.trigger('focus')
        })
    })

    requestCodeBtn.on('click', e => {
        if (requestCodeBtn.hasClass('loading')) return

        if (!verifyPhoneNumber()) return;

        requestCodeBtn.addClass('loading')
        requestCode(phoneNumberField.getPhoneNumber())
                .done(data => {
                    utils.notices.removeAllNotices()
                    utils.notices.addSuccessNotice(data.message)
                    utils.steps.slideToStep(2)

                    isNewUser = (data.is_new !== undefined && data.is_new);
                })
                .fail(jqXhr => {
                    utils.notices.removeAllNotices()
                    utils.notices.addErrorNotice(jqXhr.responseJSON.message)
                    utils.notices.shakeElement(elems.stepsContainer)
                })
                .always(() => {
                    if (typeof grecaptcha != 'undefined') grecaptcha.reset()
                    setTimeout(() => requestCodeBtn.removeClass('loading'), 500)
                })
    })

    elems = {
        ...elems,
        secondSlide,
        loginWithEmailButton,
        requestCodeBtn,
        phoneNumberField
    }
}

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
        if (index == 2) promise.then(() => {
            elems.otpContainer.focusInput()
        })
    })
    otpContainer.addEventListener('submit', () => verificationBtn.trigger('click'))
    otpContainer.addEventListener('invalidInput', e => {
        utils.notices.removeAllNotices()
        utils.notices.addErrorNotice(data.l10n.please_fill_digits_notice)
        setTimeout(() => verificationBtn.removeClass('loading'), 500)
    })

    verificationBtn.on('click', e => {
        const code = elems.otpContainer.getCode()
        if (code == false) return

        if (verificationBtn.hasClass('loading')) return

        if (!verifyPhoneNumber()) return;

        verificationBtn.addClass('loading')

        verifyCode(elems.phoneNumberField.getPhoneNumber(), code)
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
                .always(
                        setTimeout(() => verificationBtn.removeClass('loading'), 500)
                )
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

function verifyPhoneNumber() {
    if (elems.phoneNumberField.getPhoneNumber() == '') {
        utils.notices.removeAllNotices();
        utils.notices.addErrorNotice(data.l10n.invalid_phone_number);
        utils.notices.shakeElement(elems.stepsContainer);

        return false;
    }

    return true;
}

function requestCode(phoneNumber) {
    const endPoint = data.endPoints.request_otp
    const requestData = {
        "phone_number": phoneNumber
    }

    if (data.recaptcha.site_key && window.grecaptcha) {
        requestData.recaptcha_response = grecaptcha.getResponse()
    }

    return jQuery.ajax({
        "method": endPoint.method,
        "url": endPoint.url,
        "data": requestData,
        "headers": {
            [endPoint.nonce_header_key]: endPoint.nonce
        }
    })
}

function verifyCode(phoneNumber, code) {
    const endPoint = data.endPoints.login_with_otp
    return jQuery.ajax({
        "method": endPoint.method,
        "url": endPoint.url,
        "data": {
            "phone_number": phoneNumber,
            "code": code,
            "is_new": isNewUser,
        },
        "headers": {
            [endPoint.nonce_header_key]: endPoint.nonce
        }
    })
}

function initRecaptcha() {
    const recaptcha = jQuery(`<div class="wp-sms-login-form-recaptcha"></div>`).insertBefore(elems.requestCodeBtn)
    data.recaptchaId = grecaptcha.render(recaptcha.get(0), {'sitekey': data.recaptcha.site_key})
}

