<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1\Service\Conversation\Message;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $accountSid
 * @property string $chatServiceSid
 * @property string $conversationSid
 * @property string $messageSid
 * @property string $sid
 * @property string $channelMessageSid
 * @property string $participantSid
 * @property string $status
 * @property int $errorCode
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $url
 */
class DeliveryReceiptInstance extends InstanceResource
{
    /**
     * Initialize the DeliveryReceiptInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $chatServiceSid The SID of the Conversation Service that the
     *                               resource is associated with.
     * @param string $conversationSid The unique ID of the Conversation for this
     *                                message.
     * @param string $messageSid The SID of the message the delivery receipt
     *                           belongs to
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    public function __construct(Version $version, array $payload, string $chatServiceSid, string $conversationSid, string $messageSid, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'chatServiceSid' => Values::array_get($payload, 'chat_service_sid'), 'conversationSid' => Values::array_get($payload, 'conversation_sid'), 'messageSid' => Values::array_get($payload, 'message_sid'), 'sid' => Values::array_get($payload, 'sid'), 'channelMessageSid' => Values::array_get($payload, 'channel_message_sid'), 'participantSid' => Values::array_get($payload, 'participant_sid'), 'status' => Values::array_get($payload, 'status'), 'errorCode' => Values::array_get($payload, 'error_code'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')), 'url' => Values::array_get($payload, 'url')];
        $this->solution = ['chatServiceSid' => $chatServiceSid, 'conversationSid' => $conversationSid, 'messageSid' => $messageSid, 'sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return DeliveryReceiptContext Context for this DeliveryReceiptInstance
     */
    protected function proxy() : DeliveryReceiptContext
    {
        if (!$this->context) {
            $this->context = new DeliveryReceiptContext($this->version, $this->solution['chatServiceSid'], $this->solution['conversationSid'], $this->solution['messageSid'], $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the DeliveryReceiptInstance
     *
     * @return DeliveryReceiptInstance Fetched DeliveryReceiptInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : DeliveryReceiptInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->{$method}();
        }
        throw new TwilioException('Unknown property: ' . $name);
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
        return '[Twilio.Conversations.V1.DeliveryReceiptInstance ' . \implode(' ', $context) . ']';
    }
}
