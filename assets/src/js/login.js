import loginWithSms from "./modules/login-form/login-with-sms.mjs"
import twoFactorAuth from "./modules/login-form/two-factor-auth.mjs"
import {init as initLoginFormUtils} from "./modules/login-form/login-form-utils.mjs"


var loginWithSmsInitiationPromise
var twoFactorAuthInitiationPromise
document.addEventListener('DOMContentLoaded', async () => {
    if (typeof WPSmsProLoginWithSmsData != 'undefined') {
        await initLoginFormUtils(WPSmsProLoginWithSmsData)

        loginWithSmsInitiationPromise = loginWithSms.init(WPSmsProLoginWithSmsData)
    }

    if (typeof WPSmsLoginFormTwoFactorAuthData != 'undefined') {
        await initLoginFormUtils(WPSmsLoginFormTwoFactorAuthData)
        twoFactorAuthInitiationPromise = twoFactorAuth.init(WPSmsLoginFormTwoFactorAuthData)
    }
})

// TODO Improve modularity
window['WPSmsProLoginFormLoadRecaptcha'] = function () {
    loginWithSmsInitiationPromise.then(
        loginWithSms.initRecaptcha()
    )
}
