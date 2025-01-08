(()=>{"use strict";const e={addRightHandStep:function(e){const n=r.at(-1);r.push(e),d(),e.insertAfter(n??t.stepZero)},addLeftHandStep:function(e){const n=a.at(-1);a.push(e),d(),e.insertBefore(n??t.stepZero)},slideToStep:l},n={addSuccessNotice:function(e){const n=jQuery("#login > h1");jQuery(`<p class="message success">${e}</p>`).insertAfter(n)},addErrorNotice:function(e){const n=jQuery("#login > h1");jQuery(`<p class="message failure">${e}</p>`).insertAfter(n)},removeAllNotices:function(){jQuery("#login > h1").nextUntil(jQuery("div.login-form-container")).remove()},shakeElement:function(e){e.removeClass("shake"),window.setTimeout((function(){e.addClass("shake")}),50)}};var t,s,o;function i(e){return void 0===s&&(s=new Promise((n=>{const s=jQuery("#loginform");o=e,s.wrap('<div class="login-form-container"></div>'),s.wrap('<div class="login-form-steps-container"></div>'),s.wrap('<div class="login-form-step step-zero"></div>'),t={loginForm:s,stepsContainer:jQuery("div.login-form-steps-container"),stepZero:jQuery("div.login-form-step.step-zero")},n()}))),s}let r=[],a=[];function l(e){let n=o.options.is_rtl_page?"margin-right":"margin-left";switch(Math.sign(e)){case 1:var s=a.length+Math.abs(e);t.stepsContainer.css(n,-100*s+"%");break;case-1:s=a.length-Math.abs(e);t.stepsContainer.css(n,-100*s+"%");break;case 0:const o=a.length;t.stepsContainer.css(n,`-${100*o}%`)}const i=new Promise((e=>setTimeout(e,400)));return t.stepsContainer.triggerHandler("slide",[e,i]),i}function d(){const e=a.length+r.length+1;t.stepsContainer.css({css:"",width:100*e+"%"}),l(0).then((()=>t.stepsContainer.css("transition","margin 0.3s ease-in-out")))}class c extends EventTarget{constructor(e){super(),this.containerElem=e,this.inputField=this.containerElem.children(".otp-digit-input")}init(){return this.inputField.on("keydown",(e=>{let n=e.key;"Enter"==n?this.dispatchEvent(new CustomEvent("submit",{detail:{code:this.getCode()}})):n.match(/^[0-9]$/)?this.inputField.removeClass("focus-error error"):this.inputField.addClass("focus-error")})),this.dispatchEvent(new Event("initialized")),this}getCode(){let e="",n=!0,t=this.inputField.val();return t||(this.dispatchEvent(new Event("invalidInput")),jQuery(this.inputField).addClass("error"),n=!1),e+=void 0!==t?String(t):"",!!n&&e}clean(){this.inputField.val(null),this.inputField.removeClass("error")}focusInput(){this.inputField.trigger("focus")}addErrorClassToInput(){this.inputField.addClass("error")}}const u={init:function(s){void 0===m&&(m=new Promise((o=>{p={...t},h=s,function(){const n=jQuery(`\n            <div class="or-login-with-wp-sms-otp-section">\n                <div class=or-separator>\n                    <span class="line"></span>\n                    <p>${h.l10n.or}</p>\n                    <span class="line"></span>\n                </div>\n                <button class="login-with-wp-sms-otp wpsms-button" type="button">\n                    <span class="icon dashicons dashicons-email-alt"></span>\n                    ${h.l10n.login_button_text}\n                </button>\n            </div>\n        `);n.insertAfter(p.loginForm);const t=n.children("button.login-with-wp-sms-otp");t.on("click",(()=>e.slideToStep(1))),p={...p,loginWithSmsButton:t}}(),function(){const t=jQuery(`\n            <div class="login-form-step second-step">\n                <h2 class="title">${h.l10n.login_with_sms_title}</h2>\n                <h6>${h.l10n.login_with_sms_number_subtitle}</h6>\n                <div class="input-box">       \n                    <label for="phoneNumber">${h.l10n.phone_number_field_label}</label>\n                    ${h.elements.mobile_field}\n                </div>\n\n                \x3c!-- 这个就是“Referral Code”输入框，一开始隐藏 --\x3e\n                <div id="referralCodeBox" class="input-box" style="display: none;">\n                    <label for="referralCode">Referral Code</label>\n                    <input type="text" id="referralCode" name="referralCode" />\n                </div>\n\n                \x3c!-- 按钮，一开始禁用 --\x3e\n                <button class="request-otp-button wpsms-button" disabled>\n                    <span class="spinner"></span>\n                    <span>${h.l10n.request_otp_button_text}</span>\n                </button>\n                <div class=or-separator>\n                    <span class="line"></span>\n                    <p>${h.l10n.or}</p>\n                    <span class="line"></span>\n                </div>\n                <a class="or-login-regularly">\n                    <span class="icon dashicons dashicons-arrow-left-alt"></span>\n                    ${h.l10n.login_with_email_text}\n                </a>\n            </div>\n        `);let s;e.addRightHandStep(t);let o="";const i=t.children(".or-login-regularly"),r=t.children(".request-otp-button"),a=t.find("#referralCodeBox").hide(),l=jQuery("#phoneNumber").extend({getPhoneNumber(){return null==s&&void 0!==window.intlTelInput&&(s=window.intlTelInput.getInstance(l.get(0))),null==s?this.val().replace(/[-\s]/g,""):s.isValidNumber()?s.getNumber():""}}),d=jQuery("#referralCode").extend({getReferralCode(){return this.val().trim().substring(0,f)}});function c(){o="",p.capturedReferralCode=""}function u(e){let n=!(arguments.length>1&&void 0!==arguments[1])||arguments[1];e.prop("readonly",n)}function m(e){e?r.prop("disabled",!1):r.prop("disabled",!0)}function b(){a.is(":visible")||a.slideDown(200)}function C(){a.is(":hidden")||(a.slideUp(200),d.val(""))}i.on("click",(n=>e.slideToStep(0))),p.stepsContainer.on("slide",((e,n,t)=>{1==n&&t.then((()=>{l.trigger("focus")}))})),l.on("keydown",(e=>{"Enter"===e.key&&r.trigger("click")})),l.on("input",(function(){if(!_())return c(),C(),void m(!1);var e;u(l,!0),r.addClass("loading"),(e=l.getPhoneNumber(),jQuery.ajax({method:"POST",url:ajaxurl,data:{action:"check_referral_code_by_phone",phone_number:e}})).done((e=>{e.success?e.data.has_referral_code?(C(),m(!0)):(b(),m(!1)):(n.removeAllNotices(),n.addErrorNotice(e.data?.message||"Check referral code failed."),C(),m(!1))})).fail((e=>{n.removeAllNotices(),n.addErrorNotice(e.responseJSON?.message||"Server error"),C(),m(!1)})).always((()=>{u(l,!1),setTimeout((()=>r.removeClass("loading")),500)}))})),d.on("keydown",(e=>{"Enter"==e.key&&r.trigger("click")})),d.on("input",(function(){var e,t;w()?(u(l,!0),u(d,!0),r.addClass("loading"),(e=l.getPhoneNumber(),t=d.getReferralCode(),jQuery.ajax({method:"POST",url:ajaxurl,data:{action:"validate_referral_code",phone_number:e,referral_code:t}})).done((e=>{e.success&&e.data.result?(o=d.getReferralCode(),p.capturedReferralCode=d.getReferralCode(),n.removeAllNotices(),n.addSuccessNotice(e.data?.message||"Referral code valid"),m(!0)):(c(),n.removeAllNotices(),n.addErrorNotice(e.data?.message||"Invalid referral code"),m(!1))})).fail((e=>{c(),n.removeAllNotices(),n.addErrorNotice(e.responseJSON?.message||"Server error"),m(!1)})).always((()=>{setTimeout((()=>{r.removeClass("loading"),u(d,!1),u(l,!1)}),500)}))):m(!1)})),r.on("click",(t=>{r.hasClass("loading")||r.prop("disabled")||v()&&(u(l,!0),u(d,!0),r.addClass("loading"),function(e){const n=h.endPoints.request_otp,t={phone_number:e};h.recaptcha.site_key&&window.grecaptcha&&(t.recaptcha_response=grecaptcha.getResponse());return jQuery.ajax({method:n.method,url:n.url,data:t,headers:{[n.nonce_header_key]:n.nonce}})}(l.getPhoneNumber()).done((t=>{n.removeAllNotices(),n.addSuccessNotice(t.message),e.slideToStep(2),g=void 0!==t.is_new&&t.is_new})).fail((e=>{n.removeAllNotices(),n.addErrorNotice(e.responseJSON.message),n.shakeElement(p.stepsContainer)})).always((()=>{"undefined"!=typeof grecaptcha&&grecaptcha.reset(),setTimeout((()=>{r.removeClass("loading"),u(d,!1),u(l,!1)}),500)})))})),p={...p,secondSlide:t,loginWithEmailButton:i,requestCodeBtn:r,phoneNumberField:l,referralCodeField:d}}(),function(){const t=jQuery(`\n            <div class="login-form-step third-step">\n                <h2 class="title">${h.l10n.login_with_sms_title}</h2>\n                <h6>${h.l10n.login_with_sms_code_subtitle}</h6>\n                <div class="otp-input login-otp">\n                    <label>${h.l10n.login_with_sms_code_label}</label>\n                    <input class="otp-digit-input" type="text" maxlength="6">\n                </div>\n                <button class="verify-sms-otp wpsms-button" type="button">\n                    <span class="spinner"></span>\n                    <span>${h.l10n.login_button_text}</span>\n                </button>\n                <div class="request-new-code">\n                    <p>${h.l10n.request_new_code_text}</p>\n                    <a>\n                        <span class="icon dashicons dashicons-email-alt"></span>\n                        ${h.l10n.request_new_code_link}\n                    </a>\n                </div>\n            </div>\n        `);e.addRightHandStep(t);const s=new c(t.children(".otp-input.login-otp")).init(),o=t.children(".verify-sms-otp"),i=t.children(".request-new-code");p.stepsContainer.on("slide",((e,n,t)=>{2==n&&t.then((()=>{p.otpContainer.focusInput()}))})),s.addEventListener("submit",(()=>o.trigger("click"))),s.addEventListener("invalidInput",(e=>{n.removeAllNotices(),n.addErrorNotice(h.l10n.please_fill_digits_notice),setTimeout((()=>o.removeClass("loading")),500)})),o.on("click",(e=>{const t=p.otpContainer.getCode();0!=t&&(o.hasClass("loading")||v()&&(o.addClass("loading"),function(e,n,t){const s=h.endPoints.login_with_otp;return jQuery.ajax({method:s.method,url:s.url,data:{phone_number:e,code:n,referral_code:t,is_new:g},headers:{[s.nonce_header_key]:s.nonce}})}(p.phoneNumberField.getPhoneNumber(),t).done((e=>{n.removeAllNotices(),n.addSuccessNotice(e.message),setTimeout((()=>{window.location.replace(e.redirect_to)}),500)})).fail((e=>{n.removeAllNotices(),n.addErrorNotice(e.responseJSON.message),n.shakeElement(p.stepsContainer),p.otpContainer.addErrorClassToInput(),p.otpContainer.focusInput()})).always(setTimeout((()=>o.removeClass("loading")),500))))})),i.on("click",(()=>{e.slideToStep(1).then((()=>{p.otpContainer.clean()}))})),p={...p,thirdSlide:t,otpContainer:s,verificationBtn:o,requestNewCodeBtn:i}}(),o()})));return m},initRecaptcha:function(){const e=jQuery('<div class="wp-sms-login-form-recaptcha"></div>').insertBefore(p.requestCodeBtn);h.recaptchaId=grecaptcha.render(e.get(0),{sitekey:h.recaptcha.site_key})}};var p,h,m,g=!1;const f=12;function v(){return!!_()||(n.removeAllNotices(),n.addErrorNotice(h.l10n.invalid_phone_number),n.shakeElement(p.stepsContainer),!1)}function _(){return""!==p.phoneNumberField.getPhoneNumber()}function w(){return p.referralCodeField.getReferralCode().length==f}const b={init:function(s){void 0===N&&(N=new Promise((o=>{C={...t},y=s,C.loginForm.on("submit",(t=>{if(k)return;t.preventDefault();const s=jQuery("#wp-submit");s.hasClass("loading")||(s.addClass("loading"),jQuery('<span class="spinner active"></span>').insertBefore(s),E().done((t=>{k=!0,t.userNeedsVerification?(n.removeAllNotices(),n.addSuccessNotice(t.message),e.slideToStep(-1).then((()=>{C.otpContainer.focusInput()}))):C.loginForm.trigger("submit")})).always((()=>{s.removeClass("loading").siblings(".spinner").remove()})))})),function(){const t=jQuery(`\n        <div class="login-form-step two-factor-auth">\n            <h2 class="title">${y.l10n.two_factor_auth_title}</h2>\n            <h6>${y.l10n.two_factor_auth_subtitle}</h6>\n            <div class="otp-input two-factor-otp">\n                <label>${y.l10n.verification_code_label}</label>\n                <input class="otp-digit-input" type="text" maxlength="6">\n            </div>\n            <button class="submit-two-factor-otp wpsms-button" type="button">\n                <span class="spinner"></span>\n                <span>${y.l10n.submit_button_text}</span>\n            </button>\n            <div class="request-new-code">\n                <p>${y.l10n.request_new_code_text}</p>\n                <a>\n                    <span class="icon dashicons dashicons-email-alt"></span>\n                    ${y.l10n.request_new_code_link}\n                </a>\n            </div>\n        </div>\n    `);e.addLeftHandStep(t);const s=new c(t.children(".otp-input.two-factor-otp")).init(),o=t.children(".submit-two-factor-otp"),i=t.children(".request-new-code");s.addEventListener("submit",(e=>o.trigger("click"))),s.addEventListener("invalidInput",(e=>{n.removeAllNotices(),n.addErrorNotice(y.l10n.please_fill_digits_notice)})),o.on("click",(e=>{const n=s.getCode();n&&function(e){C.loginForm.append(jQuery('<input type="hidden" name="wpsms_two_factor_auth_code">').val(e)).trigger("submit")}(n)})),i.on("click",(e=>{i.attr("is-clicked")||(C.otpContainer.clean(),i.attr("is-clicked",!0),E().done((e=>{n.removeAllNotices(),n.addSuccessNotice(e.message)})).fail((e=>{if(n.removeAllNotices(),n.shakeElement(C.stepsContainer),e.responseJSON)for(let t in e.responseJSON)n.addErrorNotice(e.responseJSON[t])})).always((()=>i.removeAttr("is-clicked"))))})),C={...C,otpContainer:s,submitBtn:o,requestNewCodeBtn:i}}(),o()})));return N}};var C,y,N;var S,k=!1;function E(){const e=y.endPoints.request_code;return jQuery.ajax({method:e.method,url:e.url,data:{user_login:jQuery("#user_login").val(),user_pass:jQuery("#user_pass").val()},headers:{[e.nonce_header_key]:e.nonce}}).fail((e=>{if(n.removeAllNotices(),n.shakeElement(C.stepsContainer),e.responseJSON)for(let t in e.responseJSON)n.addErrorNotice(e.responseJSON[t])}))}document.addEventListener("DOMContentLoaded",(async()=>{"undefined"!=typeof WPSmsProLoginWithSmsData&&(await i(WPSmsProLoginWithSmsData),S=u.init(WPSmsProLoginWithSmsData)),"undefined"!=typeof WPSmsLoginFormTwoFactorAuthData&&(await i(WPSmsLoginFormTwoFactorAuthData),b.init(WPSmsLoginFormTwoFactorAuthData))})),window.WPSmsProLoginFormLoadRecaptcha=function(){S.then(u.initRecaptcha())}})();