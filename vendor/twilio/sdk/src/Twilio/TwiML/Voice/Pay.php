<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\TwiML\Voice;

use WPSmsPro\Vendor\Twilio\TwiML\TwiML;
class Pay extends TwiML
{
    /**
     * Pay constructor.
     *
     * @param array $attributes Optional attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct('Pay', null, $attributes);
    }
    /**
     * Add Prompt child.
     *
     * @param array $attributes Optional attributes
     * @return Prompt Child element.
     */
    public function prompt($attributes = []) : Prompt
    {
        return $this->nest(new Prompt($attributes));
    }
    /**
     * Add Parameter child.
     *
     * @param array $attributes Optional attributes
     * @return Parameter Child element.
     */
    public function parameter($attributes = []) : Parameter
    {
        return $this->nest(new Parameter($attributes));
    }
    /**
     * Add Input attribute.
     *
     * @param string $input Input type Twilio should accept
     */
    public function setInput($input) : self
    {
        return $this->setAttribute('input', $input);
    }
    /**
     * Add Action attribute.
     *
     * @param string $action Action URL
     */
    public function setAction($action) : self
    {
        return $this->setAttribute('action', $action);
    }
    /**
     * Add BankAccountType attribute.
     *
     * @param string $bankAccountType Bank account type for ach transactions. If
     *                                set, payment method attribute must be
     *                                provided and value should be set to
     *                                ach-debit. defaults to consumer-checking
     */
    public function setBankAccountType($bankAccountType) : self
    {
        return $this->setAttribute('bankAccountType', $bankAccountType);
    }
    /**
     * Add StatusCallback attribute.
     *
     * @param string $statusCallback Status callback URL
     */
    public function setStatusCallback($statusCallback) : self
    {
        return $this->setAttribute('statusCallback', $statusCallback);
    }
    /**
     * Add StatusCallbackMethod attribute.
     *
     * @param string $statusCallbackMethod Status callback method
     */
    public function setStatusCallbackMethod($statusCallbackMethod) : self
    {
        return $this->setAttribute('statusCallbackMethod', $statusCallbackMethod);
    }
    /**
     * Add Timeout attribute.
     *
     * @param int $timeout Time to wait to gather input
     */
    public function setTimeout($timeout) : self
    {
        return $this->setAttribute('timeout', $timeout);
    }
    /**
     * Add MaxAttempts attribute.
     *
     * @param int $maxAttempts Maximum number of allowed retries when gathering
     *                         input
     */
    public function setMaxAttempts($maxAttempts) : self
    {
        return $this->setAttribute('maxAttempts', $maxAttempts);
    }
    /**
     * Add SecurityCode attribute.
     *
     * @param bool $securityCode Prompt for security code
     */
    public function setSecurityCode($securityCode) : self
    {
        return $this->setAttribute('securityCode', $securityCode);
    }
    /**
     * Add PostalCode attribute.
     *
     * @param string $postalCode Prompt for postal code and it should be true/false
     *                           or default postal code
     */
    public function setPostalCode($postalCode) : self
    {
        return $this->setAttribute('postalCode', $postalCode);
    }
    /**
     * Add MinPostalCodeLength attribute.
     *
     * @param int $minPostalCodeLength Prompt for minimum postal code length
     */
    public function setMinPostalCodeLength($minPostalCodeLength) : self
    {
        return $this->setAttribute('minPostalCodeLength', $minPostalCodeLength);
    }
    /**
     * Add PaymentConnector attribute.
     *
     * @param string $paymentConnector Unique name for payment connector
     */
    public function setPaymentConnector($paymentConnector) : self
    {
        return $this->setAttribute('paymentConnector', $paymentConnector);
    }
    /**
     * Add PaymentMethod attribute.
     *
     * @param string $paymentMethod Payment method to be used. defaults to
     *                              credit-card
     */
    public function setPaymentMethod($paymentMethod) : self
    {
        return $this->setAttribute('paymentMethod', $paymentMethod);
    }
    /**
     * Add TokenType attribute.
     *
     * @param string $tokenType Type of token
     */
    public function setTokenType($tokenType) : self
    {
        return $this->setAttribute('tokenType', $tokenType);
    }
    /**
     * Add ChargeAmount attribute.
     *
     * @param string $chargeAmount Amount to process. If value is greater than 0
     *                             then make the payment else create a payment token
     */
    public function setChargeAmount($chargeAmount) : self
    {
        return $this->setAttribute('chargeAmount', $chargeAmount);
    }
    /**
     * Add Currency attribute.
     *
     * @param string $currency Currency of the amount attribute
     */
    public function setCurrency($currency) : self
    {
        return $this->setAttribute('currency', $currency);
    }
    /**
     * Add Description attribute.
     *
     * @param string $description Details regarding the payment
     */
    public function setDescription($description) : self
    {
        return $this->setAttribute('description', $description);
    }
    /**
     * Add ValidCardTypes attribute.
     *
     * @param string[] $validCardTypes Comma separated accepted card types
     */
    public function setValidCardTypes($validCardTypes) : self
    {
        return $this->setAttribute('validCardTypes', $validCardTypes);
    }
    /**
     * Add Language attribute.
     *
     * @param string $language Language to use
     */
    public function setLanguage($language) : self
    {
        return $this->setAttribute('language', $language);
    }
}
