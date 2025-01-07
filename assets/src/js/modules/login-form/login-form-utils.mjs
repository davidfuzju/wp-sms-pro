export const steps = { addRightHandStep, addLeftHandStep, slideToStep }
export const notices = { addSuccessNotice, addErrorNotice, removeAllNotices, shakeElement }
export { init, elems as elements }


//SECTION - Initiation
var elems
var initiationPromise
var data

function init(initialData) {
    if (typeof initiationPromise == 'undefined') initiationPromise = new Promise(resolve => {
        const loginForm = jQuery('#loginform')

        data = initialData

        loginForm.wrap('<div class="login-form-container"></div>')
        loginForm.wrap('<div class="login-form-steps-container"></div>')
        loginForm.wrap('<div class="login-form-step step-zero"></div>')

        elems = {
            loginForm,
            stepsContainer: jQuery('div.login-form-steps-container'),
            stepZero: jQuery('div.login-form-step.step-zero')
        }

        resolve()
    })
    return initiationPromise
}
//!SECTION

//SECTION - Steps
let rightHandSteps = []
let leftHandSteps = []

function addRightHandStep(step) {
    const precedingStep = rightHandSteps.at(-1)
    rightHandSteps.push(step)
    repositionContainer()
    step.insertAfter(precedingStep ?? elems.stepZero)
}
function addLeftHandStep(step) {
    const precedingStep = leftHandSteps.at(-1)
    leftHandSteps.push(step)
    repositionContainer()
    step.insertBefore(precedingStep ?? elems.stepZero)
}
function slideToStep(index) {

    let marginSide = data.options.is_rtl_page ? 'margin-right' : 'margin-left'
    switch (Math.sign(index)) {
        case +1:
            var numberOfPrecedingSteps = leftHandSteps.length + Math.abs(index)
            elems.stepsContainer.css(marginSide, `${(numberOfPrecedingSteps) * -100}%`)
            break
        case -1:
            var numberOfPrecedingSteps = leftHandSteps.length - Math.abs(index)
            elems.stepsContainer.css(marginSide, `${numberOfPrecedingSteps * -100}%`)
            break
        case 0:
            const leftHandStepsCount = leftHandSteps.length
            elems.stepsContainer.css(marginSide, `-${leftHandStepsCount * 100}%`)
            break
    }
    const promise = new Promise(resolve => setTimeout(resolve, 400))
    elems.stepsContainer.triggerHandler('slide', [index, promise])

    //* Because of .login-form-steps-container transition: margin 0.3s ease-in-out;
    return promise
}
function repositionContainer() {
    const stepsCount = (leftHandSteps.length + rightHandSteps.length) + 1
    elems.stepsContainer.css({
        css: '',
        width: `${stepsCount * 100}%`
    })
    slideToStep(0).then(() => elems.stepsContainer.css('transition', 'margin 0.3s ease-in-out'))
}
//!SECTION

//SECTION - Notices
function addSuccessNotice(msg) {
    const loginHeader = jQuery('#login > h1')
    const notice = jQuery(`<p class="message success">${msg}</p>`);
    notice.insertAfter(loginHeader)
}
function addErrorNotice(msg) {
    const loginHeader = jQuery('#login > h1')
    const notice = jQuery(`<p class="message failure">${msg}</p>`);
    notice.insertAfter(loginHeader)
}
function removeAllNotices() {
    jQuery('#login > h1').nextUntil(jQuery('div.login-form-container')).remove()
}
function shakeElement(elem) {
    elem.removeClass('shake');
    window.setTimeout(function () {
        elem.addClass('shake');
    }, 50);
}
//!SECTION

