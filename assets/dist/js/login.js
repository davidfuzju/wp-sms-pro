(()=>{"use strict";const e={addRightHandStep:function(e){const n=r.at(-1);r.push(e),d(),e.insertAfter(n??t.stepZero)},addLeftHandStep:function(e){const n=a.at(-1);a.push(e),d(),e.insertBefore(n??t.stepZero)},slideToStep:l},n={addSuccessNotice:function(e){const n=jQuery("#login > h1");jQuery(`<p class="message success">${e}</p>`).insertAfter(n)},addErrorNotice:function(e){const n=jQuery("#login > h1");jQuery(`<p class="message failure">${e}</p>`).insertAfter(n)},removeAllNotices:function(){jQuery("#login > h1").nextUntil(jQuery("div.login-form-container")).remove()},shakeElement:function(e){e.removeClass("shake"),window.setTimeout((function(){e.addClass("shake")}),50)}};var t,o,s;function i(e){return void 0===o&&(o=new Promise((n=>{const o=jQuery("#loginform");s=e,o.wrap('<div class="login-form-container"></div>'),o.wrap('<div class="login-form-steps-container"></div>'),o.wrap('<div class="login-form-step step-zero"></div>'),t={loginForm:o,stepsContainer:jQuery("div.login-form-steps-container"),stepZero:jQuery("div.login-form-step.step-zero")},n()}))),o}let r=[],a=[];function l(e){let n=s.options.is_rtl_page?"margin-right":"margin-left";switch(Math.sign(e)){case 1:var o=a.length+Math.abs(e);t.stepsContainer.css(n,-100*o+"%");break;case-1:o=a.length-Math.abs(e);t.stepsContainer.css(n,-100*o+"%");break;case 0:const s=a.length;t.stepsContainer.css(n,`-${100*s}%`)}const i=new Promise((e=>setTimeout(e,400)));return t.stepsContainer.triggerHandler("slide",[e,i]),i}function d(){const e=a.length+r.length+1;t.stepsContainer.css({css:"",width:100*e+"%"}),l(0).then((()=>t.stepsContainer.css("transition","margin 0.3s ease-in-out")))}class c extends EventTarget{constructor(e){super(),this.containerElem=e,this.inputField=this.containerElem.children(".otp-digit-input")}init(){return this.inputField.on("keydown",(e=>{let n=e.key;"Enter"==n?this.dispatchEvent(new CustomEvent("submit",{detail:{code:this.getCode()}})):n.match(/^[0-9]$/)?this.inputField.removeClass("focus-error error"):this.inputField.addClass("focus-error")})),this.dispatchEvent(new Event("initialized")),this}getCode(){let e="",n=!0,t=this.inputField.val();return t||(this.dispatchEvent(new Event("invalidInput")),jQuery(this.inputField).addClass("error"),n=!1),e+=void 0!==t?String(t):"",!!n&&e}clean(){this.inputField.val(null),this.inputField.removeClass("error")}focusInput(){this.inputField.trigger("focus")}addErrorClassToInput(){this.inputField.addClass("error")}}const u={init:function(o){void 0===m&&(m=new Promise((s=>{p={...t},h=o,function(){const n=jQuery(`\n            <div class="or-login-with-wp-sms-otp-section">\n                <div class=or-separator>\n                    <span class="line"></span>\n                    <p>${h.l10n.or}</p>\n                    <span class="line"></span>\n                </div>\n                <button class="login-with-wp-sms-otp wpsms-button" type="button">\n                    <span class="icon dashicons dashicons-email-alt"></span>\n                    ${h.l10n.login_button_text}\n                </button>\n            </div>\n        `);n.insertAfter(p.loginForm);const t=n.children("button.login-with-wp-sms-otp");t.on("click",(()=>e.slideToStep(1))),p={...p,loginWithSmsButton:t}}(),function(){const t=jQuery(`\n            <div class="login-form-step second-step">\n                <h2 class="title">${h.l10n.login_with_sms_title}</h2>\n                <h6>${h.l10n.login_with_sms_number_subtitle}</h6>\n                <div class="input-box">       \n                    <label for="phoneNumber">${h.l10n.phone_number_field_label}</label>\n                    ${h.elements.mobile_field}\n                </div>\n\n                <div id="referralCodeBox" class="input-box" style="display: none;">\n                    <label for="referralCode">${h.l10n.referral_code_field_label}</label>\n                    <input type="text" id="referralCode" name="referralCode" />\n                </div>\n\n                <button class="request-otp-button wpsms-button" disabled>\n                    <span class="spinner"></span>\n                    <span>${h.l10n.request_otp_button_text}</span>\n                </button>\n                <div class=or-separator>\n                    <span class="line"></span>\n                    <p>${h.l10n.or}</p>\n                    <span class="line"></span>\n                </div>\n                <a class="or-login-regularly">\n                    <span class="icon dashicons dashicons-arrow-left-alt"></span>\n                    ${h.l10n.login_with_email_text}\n                </a>\n            </div>\n        `);let o;e.addRightHandStep(t);const s=t.children(".or-login-regularly"),i=t.children(".request-otp-button"),r=t.find("#referralCodeBox").hide(),a=jQuery("#phoneNumber").extend({getPhoneNumber(){return null==o&&void 0!==window.intlTelInput&&(o=window.intlTelInput.getInstance(a.get(0))),null==o?this.val().replace(/[-\s]/g,""):o.isValidNumber()?o.getNumber():""}}),l=jQuery("#referralCode").extend({getReferralCode(){return this.val().trim().substring(0,f)}});function d(){const e=_("refer_code");v(e)?(l.val(""),p.capturedReferralCode=""):(l.val(e),p.capturedReferralCode=e);const n=_("refer_url");v(n)?p.capturedReferralUrl="":p.capturedReferralUrl=n}function c(e){let n=!(arguments.length>1&&void 0!==arguments[1])||arguments[1];e.prop("readonly",n)}function u(e){e?i.prop("disabled",!1):i.prop("disabled",!0)}function m(){r.is(":visible")||r.slideDown(200)}function y(){r.is(":hidden")||(r.slideUp(200),l.val(""))}d(),s.on("click",(n=>e.slideToStep(0))),p.stepsContainer.on("slide",((e,n,t)=>{1==n&&t.then((()=>{a.trigger("focus")}))})),a.on("keydown",(e=>{"Enter"===e.key&&i.trigger("click")})),a.on("input",(function(){if(!w())return d(),y(),void u(!1);var e;c(a,!0),i.addClass("loading"),(e=a.getPhoneNumber(),jQuery.ajax({method:"POST",url:ajaxurl,data:{action:"check_referral_code_by_phone",phone_number:e}})).done((e=>{e.success?e.data.has_referral_code?(y(),u(!0)):(m(),u(!1)):(n.removeAllNotices(),n.addErrorNotice(e.data?.message||"Check referral code failed."),y(),u(!1))})).fail((e=>{n.removeAllNotices(),n.addErrorNotice(e.responseJSON?.message||"Server error"),y(),u(!1)})).always((()=>{c(a,!1),setTimeout((()=>i.removeClass("loading")),500)}))})),l.on("keydown",(e=>{"Enter"==e.key&&i.trigger("click")})),l.on("input",(function(){var e,t;C()?(c(a,!0),c(l,!0),i.addClass("loading"),(e=a.getPhoneNumber(),t=l.getReferralCode(),jQuery.ajax({method:"POST",url:ajaxurl,data:{action:"validate_referral_code",phone_number:e,referral_code:t}})).done((e=>{e.success&&e.data.result?(p.capturedReferralCode=l.getReferralCode(),n.removeAllNotices(),n.addSuccessNotice(e.data?.message||"Referral code valid"),u(!0)):(d(),n.removeAllNotices(),n.addErrorNotice(e.data?.message||"Invalid referral code"),u(!1))})).fail((e=>{d(),n.removeAllNotices(),n.addErrorNotice(e.responseJSON?.message||"Server error"),u(!1)})).always((()=>{setTimeout((()=>{i.removeClass("loading"),c(l,!1),c(a,!1)}),500)}))):u(!1)})),i.on("click",(t=>{i.hasClass("loading")||i.prop("disabled")||b()&&(c(a,!0),c(l,!0),i.addClass("loading"),function(e){const n=h.endPoints.request_otp,t={phone_number:e};h.recaptcha.site_key&&window.grecaptcha&&(t.recaptcha_response=grecaptcha.getResponse());return jQuery.ajax({method:n.method,url:n.url,data:t,headers:{[n.nonce_header_key]:n.nonce}})}(a.getPhoneNumber()).done((t=>{n.removeAllNotices(),n.addSuccessNotice(t.message),e.slideToStep(2),g=void 0!==t.is_new&&t.is_new})).fail((e=>{n.removeAllNotices(),n.addErrorNotice(e.responseJSON.message),n.shakeElement(p.stepsContainer)})).always((()=>{"undefined"!=typeof grecaptcha&&grecaptcha.reset(),setTimeout((()=>{i.removeClass("loading"),c(l,!1),c(a,!1)}),500)})))})),p={...p,secondSlide:t,loginWithEmailButton:s,requestCodeBtn:i,phoneNumberField:a,referralCodeField:l}}(),function(){const t=jQuery(`\n            <div class="login-form-step third-step">\n                <h2 class="title">${h.l10n.login_with_sms_title}</h2>\n                <h6>${h.l10n.login_with_sms_code_subtitle}</h6>\n                <div class="otp-input login-otp">\n                    <label>${h.l10n.login_with_sms_code_label}</label>\n                    <input class="otp-digit-input" type="text" maxlength="6">\n                </div>\n                <button class="verify-sms-otp wpsms-button" type="button">\n                    <span class="spinner"></span>\n                    <span>${h.l10n.login_button_text}</span>\n                </button>\n                <div class="request-new-code">\n                    <p>${h.l10n.request_new_code_text}</p>\n                    <a>\n                        <span class="icon dashicons dashicons-email-alt"></span>\n                        ${h.l10n.request_new_code_link}\n                    </a>\n                </div>\n            </div>\n        `);e.addRightHandStep(t);const o=new c(t.children(".otp-input.login-otp")).init(),s=t.children(".verify-sms-otp"),i=t.children(".request-new-code");p.stepsContainer.on("slide",((e,n,t)=>{2==n&&t.then((()=>{p.otpContainer.focusInput()}))})),o.addEventListener("submit",(()=>s.trigger("click"))),o.addEventListener("invalidInput",(e=>{n.removeAllNotices(),n.addErrorNotice(h.l10n.please_fill_digits_notice),setTimeout((()=>s.removeClass("loading")),500)})),s.on("click",(e=>{const t=p.otpContainer.getCode();0!=t&&(s.hasClass("loading")||b()&&(s.addClass("loading"),function(e,n,t,o){const s=h.endPoints.login_with_otp;return jQuery.ajax({method:s.method,url:s.url,data:{phone_number:e,code:n,referral_code:t,referral_url:o,is_new:g},headers:{[s.nonce_header_key]:s.nonce}})}(p.phoneNumberField.getPhoneNumber(),t,p.capturedReferralCode,p.capturedReferralUrl).done((e=>{n.removeAllNotices(),n.addSuccessNotice(e.message),setTimeout((()=>{window.location.replace(e.redirect_to)}),500)})).fail((e=>{n.removeAllNotices(),n.addErrorNotice(e.responseJSON.message),n.shakeElement(p.stepsContainer),p.otpContainer.addErrorClassToInput(),p.otpContainer.focusInput()})).always(setTimeout((()=>s.removeClass("loading")),500))))})),i.on("click",(()=>{e.slideToStep(1).then((()=>{p.otpContainer.clean()}))})),p={...p,thirdSlide:t,otpContainer:o,verificationBtn:s,requestNewCodeBtn:i}}(),s()})));return m},initRecaptcha:function(){const e=jQuery('<div class="wp-sms-login-form-recaptcha"></div>').insertBefore(p.requestCodeBtn);h.recaptchaId=grecaptcha.render(e.get(0),{sitekey:h.recaptcha.site_key})}};var p,h,m,g=!1;const f=12;function v(e){return null==e||("boolean"==typeof e?!1===e:"number"==typeof e&&0===e||"0"===e||("string"==typeof e?0===e.trim().length:Array.isArray(e)?0===e.length:"object"==typeof e&&0===Object.keys(e).length))}function _(e){const n=e+"=",t=document.cookie.split(";");for(let e=0;e<t.length;e++){let o=t[e].trim();if(0===o.indexOf(n)){return decodeURIComponent(o.substring(n.length,o.length))||""}}return""}function b(){return!!w()||(n.removeAllNotices(),n.addErrorNotice(h.l10n.invalid_phone_number),n.shakeElement(p.stepsContainer),!1)}function w(){return""!==p.phoneNumberField.getPhoneNumber()}function C(){return p.referralCodeField.getReferralCode().length==f}const y={init:function(o){void 0===k&&(k=new Promise((s=>{N={...t},S=o,N.loginForm.on("submit",(t=>{if(j)return;t.preventDefault();const o=jQuery("#wp-submit");o.hasClass("loading")||(o.addClass("loading"),jQuery('<span class="spinner active"></span>').insertBefore(o),x().done((t=>{j=!0,t.userNeedsVerification?(n.removeAllNotices(),n.addSuccessNotice(t.message),e.slideToStep(-1).then((()=>{N.otpContainer.focusInput()}))):N.loginForm.trigger("submit")})).always((()=>{o.removeClass("loading").siblings(".spinner").remove()})))})),function(){const t=jQuery(`\n        <div class="login-form-step two-factor-auth">\n            <h2 class="title">${S.l10n.two_factor_auth_title}</h2>\n            <h6>${S.l10n.two_factor_auth_subtitle}</h6>\n            <div class="otp-input two-factor-otp">\n                <label>${S.l10n.verification_code_label}</label>\n                <input class="otp-digit-input" type="text" maxlength="6">\n            </div>\n            <button class="submit-two-factor-otp wpsms-button" type="button">\n                <span class="spinner"></span>\n                <span>${S.l10n.submit_button_text}</span>\n            </button>\n            <div class="request-new-code">\n                <p>${S.l10n.request_new_code_text}</p>\n                <a>\n                    <span class="icon dashicons dashicons-email-alt"></span>\n                    ${S.l10n.request_new_code_link}\n                </a>\n            </div>\n        </div>\n    `);e.addLeftHandStep(t);const o=new c(t.children(".otp-input.two-factor-otp")).init(),s=t.children(".submit-two-factor-otp"),i=t.children(".request-new-code");o.addEventListener("submit",(e=>s.trigger("click"))),o.addEventListener("invalidInput",(e=>{n.removeAllNotices(),n.addErrorNotice(S.l10n.please_fill_digits_notice)})),s.on("click",(e=>{const n=o.getCode();n&&function(e){N.loginForm.append(jQuery('<input type="hidden" name="wpsms_two_factor_auth_code">').val(e)).trigger("submit")}(n)})),i.on("click",(e=>{i.attr("is-clicked")||(N.otpContainer.clean(),i.attr("is-clicked",!0),x().done((e=>{n.removeAllNotices(),n.addSuccessNotice(e.message)})).fail((e=>{if(n.removeAllNotices(),n.shakeElement(N.stepsContainer),e.responseJSON)for(let t in e.responseJSON)n.addErrorNotice(e.responseJSON[t])})).always((()=>i.removeAttr("is-clicked"))))})),N={...N,otpContainer:o,submitBtn:s,requestNewCodeBtn:i}}(),s()})));return k}};var N,S,k;var E,j=!1;function x(){const e=S.endPoints.request_code;return jQuery.ajax({method:e.method,url:e.url,data:{user_login:jQuery("#user_login").val(),user_pass:jQuery("#user_pass").val()},headers:{[e.nonce_header_key]:e.nonce}}).fail((e=>{if(n.removeAllNotices(),n.shakeElement(N.stepsContainer),e.responseJSON)for(let t in e.responseJSON)n.addErrorNotice(e.responseJSON[t])}))}document.addEventListener("DOMContentLoaded",(async()=>{"undefined"!=typeof WPSmsProLoginWithSmsData&&(await i(WPSmsProLoginWithSmsData),E=u.init(WPSmsProLoginWithSmsData)),"undefined"!=typeof WPSmsLoginFormTwoFactorAuthData&&(await i(WPSmsLoginFormTwoFactorAuthData),y.init(WPSmsLoginFormTwoFactorAuthData))})),window.WPSmsProLoginFormLoadRecaptcha=function(){E.then(u.initRecaptcha())}})();