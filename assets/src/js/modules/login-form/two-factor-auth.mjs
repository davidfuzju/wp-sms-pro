import * as utils from "./login-form-utils.mjs"
import otpInput from "../otp/otp-input.mjs"

export default {init}

var elems
var data
var initiationPromise
var requestedOtps = 0

function init(d) {
    if (typeof initiationPromise == 'undefined') initiationPromise = new Promise((resolve) => {
        elems = {
            ...utils.elements,
        }
        data = d

        addInterceptionToLoginForm()
        addTwoFactorAuthStep()

        resolve()
    })
    return initiationPromise
}

var otpIsVerified = false

function addInterceptionToLoginForm() {
    elems.loginForm.on('submit', e => {
        if (otpIsVerified) return

        e.preventDefault()

        const loginBtn = jQuery('#wp-submit')

        if (loginBtn.hasClass('loading')) return

        loginBtn.addClass('loading')

        jQuery('<span class="spinner active"></span>').insertBefore(loginBtn)

        requestCode()
                .done(data => {
                    otpIsVerified = true
                    requestedOtps++

                    if (!data.userNeedsVerification) {
                        elems.loginForm.trigger('submit')
                        return
                    }

                    utils.notices.removeAllNotices()
                    utils.notices.addSuccessNotice(data.message)
                    utils.steps.slideToStep(-1).then(() => {
                        elems.otpContainer.focusInput()
                    })
                })
                .always(() => {
                    loginBtn
                            .removeClass('loading')
                            .siblings('.spinner')
                            .remove()
                })

    })
}

function addTwoFactorAuthStep() {
    const twoFactorStep = jQuery(`
        <div class="login-form-step two-factor-auth">
            <h2 class="title">${data.l10n.two_factor_auth_title}</h2>
            <h6>${data.l10n.two_factor_auth_subtitle}</h6>
            <div class="otp-input two-factor-otp">
                <label>${data.l10n.verification_code_label}</label>
                <input class="otp-digit-input" type="text" maxlength="6">
            </div>
            <button class="submit-two-factor-otp wpsms-button" type="button">
                <span class="spinner"></span>
                <span>${data.l10n.submit_button_text}</span>
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
    utils.steps.addLeftHandStep(twoFactorStep)

    const otpContainer = new otpInput(twoFactorStep.children('.otp-input.two-factor-otp')).init()
    const submitBtn = twoFactorStep.children('.submit-two-factor-otp')
    const requestNewCodeBtn = twoFactorStep.children('.request-new-code')

    otpContainer.addEventListener('submit', e => submitBtn.trigger('click'))
    otpContainer.addEventListener('invalidInput', e => {
        utils.notices.removeAllNotices()
        utils.notices.addErrorNotice(data.l10n.please_fill_digits_notice)
    })

    submitBtn.on('click', e => {
        const code = otpContainer.getCode()
        if (code) submitLoginForm(code)
    })

    requestNewCodeBtn.on('click', e => {
        if (requestNewCodeBtn.attr('is-clicked')) return

        elems.otpContainer.clean()

        requestNewCodeBtn.attr('is-clicked', true)
        requestCode()
                .done(data => {
                    requestedOtps++
                    utils.notices.removeAllNotices()
                    utils.notices.addSuccessNotice(data.message)
                })
                .fail(jqXhr => {
                    utils.notices.removeAllNotices()
                    utils.notices.shakeElement(elems.stepsContainer)
                    if (jqXhr.responseJSON) {
                        for (let errorMessage in jqXhr.responseJSON) {
                            utils.notices.addErrorNotice(jqXhr.responseJSON[errorMessage])
                        }
                    }
                })
                .always(() => requestNewCodeBtn.removeAttr('is-clicked'))

    })

    elems = {
        ...elems,
        otpContainer,
        submitBtn,
        requestNewCodeBtn,
    }
}

function submitLoginForm(code) {
    elems.loginForm
            .append(jQuery(`<input type="hidden" name="wpsms_two_factor_auth_code">`).val(code))
            .trigger('submit')
}

function requestCode() {
    const endPoint = data.endPoints.request_code
    return jQuery.ajax({
        "method": endPoint.method,
        "url": endPoint.url,
        "data": {
            'user_login': jQuery('#user_login').val(),
            'user_pass': jQuery('#user_pass').val(),
        },
        "headers": {
            [endPoint.nonce_header_key]: endPoint.nonce
        }
    }).fail((jqXhr) => {
        utils.notices.removeAllNotices()
        utils.notices.shakeElement(elems.stepsContainer)
        if (jqXhr.responseJSON) {
            for (let errorMessage in jqXhr.responseJSON) {
                utils.notices.addErrorNotice(jqXhr.responseJSON[errorMessage])
            }
        }
    })
}