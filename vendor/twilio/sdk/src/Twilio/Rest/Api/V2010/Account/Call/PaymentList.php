<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\Call;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class PaymentList extends ListResource
{
    /**
     * Construct the PaymentList
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the Account that created the Payments
     *                           resource.
     * @param string $callSid The SID of the Call the resource is associated with.
     */
    public function __construct(Version $version, string $accountSid, string $callSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['accountSid' => $accountSid, 'callSid' => $callSid];
        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/Calls/' . \rawurlencode($callSid) . '/Payments.json';
    }
    /**
     * Create the PaymentInstance
     *
     * @param string $idempotencyKey A unique token that will be used to ensure
     *                               that multiple API calls with the same
     *                               information do not result in multiple
     *                               transactions.
     * @param string $statusCallback Provide an absolute or relative URL to receive
     *                               status updates regarding your Pay session..
     * @param array|Options $options Optional Arguments
     * @return PaymentInstance Created PaymentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $idempotencyKey, string $statusCallback, array $options = []) : PaymentInstance
    {
        $options = new Values($options);
        $data = Values::of(['IdempotencyKey' => $idempotencyKey, 'StatusCallback' => $statusCallback, 'BankAccountType' => $options['bankAccountType'], 'ChargeAmount' => $options['chargeAmount'], 'Currency' => $options['currency'], 'Description' => $options['description'], 'Input' => $options['input'], 'MinPostalCodeLength' => $options['minPostalCodeLength'], 'Parameter' => Serialize::jsonObject($options['parameter']), 'PaymentConnector' => $options['paymentConnector'], 'PaymentMethod' => $options['paymentMethod'], 'PostalCode' => Serialize::booleanToString($options['postalCode']), 'SecurityCode' => Serialize::booleanToString($options['securityCode']), 'Timeout' => $options['timeout'], 'TokenType' => $options['tokenType'], 'ValidCardTypes' => $options['validCardTypes']]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new PaymentInstance($this->version, $payload, $this->solution['accountSid'], $this->solution['callSid']);
    }
    /**
     * Constructs a PaymentContext
     *
     * @param string $sid The SID of Payments session
     */
    public function getContext(string $sid) : PaymentContext
    {
        return new PaymentContext($this->version, $this->solution['accountSid'], $this->solution['callSid'], $sid);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Api.V2010.PaymentList]';
    }
}
