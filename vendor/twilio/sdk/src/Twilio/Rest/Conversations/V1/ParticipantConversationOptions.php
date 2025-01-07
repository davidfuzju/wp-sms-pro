<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class ParticipantConversationOptions
{
    /**
     * @param string $identity A unique string identifier for the conversation
     *                         participant as Conversation User.
     * @param string $address A unique string identifier for the conversation
     *                        participant who's not a Conversation User.
     * @return ReadParticipantConversationOptions Options builder
     */
    public static function read(string $identity = Values::NONE, string $address = Values::NONE) : ReadParticipantConversationOptions
    {
        return new ReadParticipantConversationOptions($identity, $address);
    }
}
class ReadParticipantConversationOptions extends Options
{
    /**
     * @param string $identity A unique string identifier for the conversation
     *                         participant as Conversation User.
     * @param string $address A unique string identifier for the conversation
     *                        participant who's not a Conversation User.
     */
    public function __construct(string $identity = Values::NONE, string $address = Values::NONE)
    {
        $this->options['identity'] = $identity;
        $this->options['address'] = $address;
    }
    /**
     * A unique string identifier for the conversation participant as [Conversation User](https://www.twilio.com/docs/conversations/api/user-resource). This parameter is non-null if (and only if) the participant is using the Conversations SDK to communicate. Limited to 256 characters.
     *
     * @param string $identity A unique string identifier for the conversation
     *                         participant as Conversation User.
     * @return $this Fluent Builder
     */
    public function setIdentity(string $identity) : self
    {
        $this->options['identity'] = $identity;
        return $this;
    }
    /**
     * A unique string identifier for the conversation participant who's not a Conversation User. This parameter could be found in messaging_binding.address field of Participant resource. It should be url-encoded.
     *
     * @param string $address A unique string identifier for the conversation
     *                        participant who's not a Conversation User.
     * @return $this Fluent Builder
     */
    public function setAddress(string $address) : self
    {
        $this->options['address'] = $address;
        return $this;
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Conversations.V1.ReadParticipantConversationOptions ' . $options . ']';
    }
}
