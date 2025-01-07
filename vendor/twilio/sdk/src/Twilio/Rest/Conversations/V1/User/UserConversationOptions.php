<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1\User;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class UserConversationOptions
{
    /**
     * @param string $notificationLevel The Notification Level of this User
     *                                  Conversation.
     * @param \DateTime $lastReadTimestamp The date of the last message read in
     *                                     conversation by the user.
     * @param int $lastReadMessageIndex The index of the last read Message.
     * @return UpdateUserConversationOptions Options builder
     */
    public static function update(string $notificationLevel = Values::NONE, \DateTime $lastReadTimestamp = Values::NONE, int $lastReadMessageIndex = Values::NONE) : UpdateUserConversationOptions
    {
        return new UpdateUserConversationOptions($notificationLevel, $lastReadTimestamp, $lastReadMessageIndex);
    }
}
class UpdateUserConversationOptions extends Options
{
    /**
     * @param string $notificationLevel The Notification Level of this User
     *                                  Conversation.
     * @param \DateTime $lastReadTimestamp The date of the last message read in
     *                                     conversation by the user.
     * @param int $lastReadMessageIndex The index of the last read Message.
     */
    public function __construct(string $notificationLevel = Values::NONE, \DateTime $lastReadTimestamp = Values::NONE, int $lastReadMessageIndex = Values::NONE)
    {
        $this->options['notificationLevel'] = $notificationLevel;
        $this->options['lastReadTimestamp'] = $lastReadTimestamp;
        $this->options['lastReadMessageIndex'] = $lastReadMessageIndex;
    }
    /**
     * The Notification Level of this User Conversation. One of `default` or `muted`.
     *
     * @param string $notificationLevel The Notification Level of this User
     *                                  Conversation.
     * @return $this Fluent Builder
     */
    public function setNotificationLevel(string $notificationLevel) : self
    {
        $this->options['notificationLevel'] = $notificationLevel;
        return $this;
    }
    /**
     * The date of the last message read in conversation by the user, given in ISO 8601 format.
     *
     * @param \DateTime $lastReadTimestamp The date of the last message read in
     *                                     conversation by the user.
     * @return $this Fluent Builder
     */
    public function setLastReadTimestamp(\DateTime $lastReadTimestamp) : self
    {
        $this->options['lastReadTimestamp'] = $lastReadTimestamp;
        return $this;
    }
    /**
     * The index of the last Message in the Conversation that the Participant has read.
     *
     * @param int $lastReadMessageIndex The index of the last read Message.
     * @return $this Fluent Builder
     */
    public function setLastReadMessageIndex(int $lastReadMessageIndex) : self
    {
        $this->options['lastReadMessageIndex'] = $lastReadMessageIndex;
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
        return '[Twilio.Conversations.V1.UpdateUserConversationOptions ' . $options . ']';
    }
}
