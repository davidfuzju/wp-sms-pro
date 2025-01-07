export {OtpInput as default}

class OtpInput extends EventTarget {

    constructor(containerElem) {
        super()
        this.containerElem = containerElem
        this.inputField = this.containerElem.children('.otp-digit-input')
    }

    init() {
        this.inputField.on('keydown', (e) => {
            let newKey = e.key;
            if (newKey == 'Enter') {
                this.dispatchEvent(new CustomEvent('submit', {detail: {code: this.getCode()}}))
            } else {
                if (newKey.match(/^[0-9]$/)) {
                    this.inputField.removeClass('focus-error error')
                } else {
                    this.inputField.addClass('focus-error')
                }
            }
        });

        this.dispatchEvent(new Event('initialized'))
        return this
    }

    getCode() {
        let code = '';
        let result = true;

        let value = this.inputField.val();
        if (!value) {
            this.dispatchEvent(new Event('invalidInput'))
            jQuery(this.inputField).addClass('error')
            result = false
        }
        code += typeof value !== 'undefined' ? String(value) : '';
        return result ? code : false;
    }

    clean() {
        this.inputField.val(null)
        this.inputField.removeClass('error')
    }

    focusInput() {
        this.inputField.trigger('focus')
    }

    addErrorClassToInput() {
        this.inputField.addClass('error')
    }
}