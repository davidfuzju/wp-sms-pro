<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1\Service\User;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class UserConversationContext extends InstanceContext
{
    /**
     * Initialize the UserConversationContext
     *
     * @param Version $version Version that contains the resource
     * @param string $chatServiceSid The SID of the Conversation Service that the
     *                               resource is associated with.
     * @param string $userSid The unique SID identifier of the User.
     * @param string $conversationSid The unique SID identifier of the Conversation.
     */
    public function __construct(Version $version, $chatServiceSid, $userSid, $conversationSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['chatServiceSid' => $chatServiceSid, 'userSid' => $userSid, 'conversationSid' => $conversationSid];
        $this->uri = '/Services/' . \rawurlencode($chatServiceSid) . '/Users/' . \rawurlencode($userSid) . '/Conversations/' . \rawurlencode($conversationSid) . '';
    }
    /**
     * Update the UserConversationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return UserConversationInstance Updated UserConversationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : UserConversationInstance
    {
        $options = new Values($options);
        $data = Values::of(['NotificationLevel' => $options['notificationLevel'], 'LastReadTimestamp' => Serialize::iso8601DateTime($options['lastReadTimestamp']), 'LastReadMessageIndex' => $options['lastReadMessageIndex']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new UserConversationInstance($this->version, $payload, $this->solution['chatServiceSid'], $this->solution['userSid'], $this->solution['conversationSid']);
    }
    /**
     * Delete the UserConversationInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Fetch the UserConversationInstance
     *
     * @return UserConversationInstance Fetched UserConversationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : UserConversationInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new UserConversationInstance($this->version, $payload, $this->solution['chatServiceSid'], $this->solution['userSid'], $this->solution['conversationSid']);
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
        return '[Twilio.Conversations.V1.UserConversationContext ' . \implode(' ', $context) . ']';
    }
}
