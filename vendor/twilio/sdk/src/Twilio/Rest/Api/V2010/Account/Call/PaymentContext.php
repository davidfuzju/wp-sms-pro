<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\Call;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class PaymentContext extends InstanceContext
{
    /**
     * Initialize the PaymentContext
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the Account that will update the
     *                           resource
     * @param string $callSid The SID of the call that will create the resource.
     * @param string $sid The SID of Payments session
     */
    public function __construct(Version $version, $accountSid, $callSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['accountSid' => $accountSid, 'callSid' => $callSid, 'sid' => $sid];
        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/Calls/' . \rawurlencode($callSid) . '/Payments/' . \rawurlencode($sid) . '.json';
    }
    /**
     * Update the PaymentInstance
     *
     * @param string $idempotencyKey A unique token that will be used to ensure
     *                               that multiple API calls with the same
     *                               information do not result in multiple
     *                               transactions.
     * @param string $statusCallback Provide an absolute or relative URL to receive
     *                               status updates regarding your Pay session.
     * @param array|Options $options Optional Arguments
     * @return PaymentInstance Updated PaymentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(string $idempotencyKey, string $statusCallback, array $options = []) : PaymentInstance
    {
        $options = new Values($options);
        $data = Values::of(['IdempotencyKey' => $idempotencyKey, 'StatusCallback' => $statusCallback, 'Capture' => $options['capture'], 'Status' => $options['status']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new PaymentInstance($this->version, $payload, $this->solution['accountSid'], $this->solution['callSid'], $this->solution['sid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "{$key}={$value}";
        }
        return '[Twilio.Api.V2010.PaymentContext ' . \implode(' ', $context) . ']';
    }
}
