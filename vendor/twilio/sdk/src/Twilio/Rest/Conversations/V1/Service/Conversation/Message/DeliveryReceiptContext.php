<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1\Service\Conversation\Message;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class DeliveryReceiptContext extends InstanceContext
{
    /**
     * Initialize the DeliveryReceiptContext
     *
     * @param Version $version Version that contains the resource
     * @param string $chatServiceSid The SID of the Conversation Service that the
     *                               resource is associated with.
     * @param string $conversationSid The unique ID of the Conversation for this
     *                                delivery receipt.
     * @param string $messageSid The SID of the message the delivery receipt
     *                           belongs to.
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    public function __construct(Version $version, $chatServiceSid, $conversationSid, $messageSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['chatServiceSid' => $chatServiceSid, 'conversationSid' => $conversationSid, 'messageSid' => $messageSid, 'sid' => $sid];
        $this->uri = '/Services/' . \rawurlencode($chatServiceSid) . '/Conversations/' . \rawurlencode($conversationSid) . '/Messages/' . \rawurlencode($messageSid) . '/Receipts/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the DeliveryReceiptInstance
     *
     * @return DeliveryReceiptInstance Fetched DeliveryReceiptInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : DeliveryReceiptInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new DeliveryReceiptInstance($this->version, $payload, $this->solution['chatServiceSid'], $this->solution['conversationSid'], $this->solution['messageSid'], $this->solution['sid']);
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
        return '[Twilio.Conversations.V1.DeliveryReceiptContext ' . \implode(' ', $context) . ']';
    }
}
