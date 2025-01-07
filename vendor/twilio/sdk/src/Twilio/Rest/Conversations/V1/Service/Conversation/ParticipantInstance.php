<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1\Service\Conversation;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $accountSid
 * @property string $chatServiceSid
 * @property string $conversationSid
 * @property string $sid
 * @property string $identity
 * @property string $attributes
 * @property array $messagingBinding
 * @property string $roleSid
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $url
 * @property int $lastReadMessageIndex
 * @property string $lastReadTimestamp
 */
class ParticipantInstance extends InstanceResource
{
    /**
     * Initialize the ParticipantInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $chatServiceSid The SID of the Conversation Service that the
     *                               resource is associated with.
     * @param string $conversationSid The unique ID of the Conversation for this
     *                                participant.
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    public function __construct(Version $version, array $payload, string $chatServiceSid, string $conversationSid, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'chatServiceSid' => Values::array_get($payload, 'chat_service_sid'), 'conversationSid' => Values::array_get($payload, 'conversation_sid'), 'sid' => Values::array_get($payload, 'sid'), 'identity' => Values::array_get($payload, 'identity'), 'attributes' => Values::array_get($payload, 'attributes'), 'messagingBinding' => Values::array_get($payload, 'messaging_binding'), 'roleSid' => Values::array_get($payload, 'role_sid'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')), 'url' => Values::array_get($payload, 'url'), 'lastReadMessageIndex' => Values::array_get($payload, 'last_read_message_index'), 'lastReadTimestamp' => Values::array_get($payload, 'last_read_timestamp')];
        $this->solution = ['chatServiceSid' => $chatServiceSid, 'conversationSid' => $conversationSid, 'sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return ParticipantContext Context for this ParticipantInstance
     */
    protected function proxy() : ParticipantContext
    {
        if (!$this->context) {
            $this->context = new ParticipantContext($this->version, $this->solution['chatServiceSid'], $this->solution['conversationSid'], $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Update the ParticipantInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ParticipantInstance Updated ParticipantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : ParticipantInstance
    {
        return $this->proxy()->update($options);
    }
    /**
     * Delete the ParticipantInstance
     *
     * @param array|Options $options Optional Arguments
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(array $options = []) : bool
    {
        return $this->proxy()->delete($options);
    }
    /**
     * Fetch the ParticipantInstance
     *
     * @return ParticipantInstance Fetched ParticipantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : ParticipantInstance
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
        return '[Twilio.Conversations.V1.ParticipantInstance ' . \implode(' ', $context) . ']';
    }
}
