<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Chat\V2\Service\Channel;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class MemberOptions
{
    /**
     * @param string $roleSid The SID of the Role to assign to the member
     * @param int $lastConsumedMessageIndex The index of the last Message in the
     *                                      Channel the Member has read
     * @param \DateTime $lastConsumptionTimestamp The ISO 8601 based timestamp
     *                                            string representing the datetime
     *                                            of the last Message read event
     *                                            for the member within the Channel
     * @param \DateTime $dateCreated The ISO 8601 date and time in GMT when the
     *                               resource was created
     * @param \DateTime $dateUpdated The ISO 8601 date and time in GMT when the
     *                               resource was updated
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return CreateMemberOptions Options builder
     */
    public static function create(string $roleSid = Values::NONE, int $lastConsumedMessageIndex = Values::NONE, \DateTime $lastConsumptionTimestamp = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $attributes = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE) : CreateMemberOptions
    {
        return new CreateMemberOptions($roleSid, $lastConsumedMessageIndex, $lastConsumptionTimestamp, $dateCreated, $dateUpdated, $attributes, $xTwilioWebhookEnabled);
    }
    /**
     * @param string[] $identity The `identity` value of the resources to read
     * @return ReadMemberOptions Options builder
     */
    public static function read(array $identity = Values::ARRAY_NONE) : ReadMemberOptions
    {
        return new ReadMemberOptions($identity);
    }
    /**
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return DeleteMemberOptions Options builder
     */
    public static function delete(string $xTwilioWebhookEnabled = Values::NONE) : DeleteMemberOptions
    {
        return new DeleteMemberOptions($xTwilioWebhookEnabled);
    }
    /**
     * @param string $roleSid The SID of the Role to assign to the member
     * @param int $lastConsumedMessageIndex The index of the last consumed Message
     *                                      for the Channel for the Member
     * @param \DateTime $lastConsumptionTimestamp The ISO 8601 based timestamp
     *                                            string representing the datetime
     *                                            of the last Message read event
     *                                            for the Member within the Channel
     * @param \DateTime $dateCreated The ISO 8601 date and time in GMT when the
     *                               resource was created
     * @param \DateTime $dateUpdated The ISO 8601 date and time in GMT when the
     *                               resource was updated
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return UpdateMemberOptions Options builder
     */
    public static function update(string $roleSid = Values::NONE, int $lastConsumedMessageIndex = Values::NONE, \DateTime $lastConsumptionTimestamp = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $attributes = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE) : UpdateMemberOptions
    {
        return new UpdateMemberOptions($roleSid, $lastConsumedMessageIndex, $lastConsumptionTimestamp, $dateCreated, $dateUpdated, $attributes, $xTwilioWebhookEnabled);
    }
}
class CreateMemberOptions extends Options
{
    /**
     * @param string $roleSid The SID of the Role to assign to the member
     * @param int $lastConsumedMessageIndex The index of the last Message in the
     *                                      Channel the Member has read
     * @param \DateTime $lastConsumptionTimestamp The ISO 8601 based timestamp
     *                                            string representing the datetime
     *                                            of the last Message read event
     *                                            for the member within the Channel
     * @param \DateTime $dateCreated The ISO 8601 date and time in GMT when the
     *                               resource was created
     * @param \DateTime $dateUpdated The ISO 8601 date and time in GMT when the
     *                               resource was updated
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     */
    public function __construct(string $roleSid = Values::NONE, int $lastConsumedMessageIndex = Values::NONE, \DateTime $lastConsumptionTimestamp = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $attributes = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE)
    {
        $this->options['roleSid'] = $roleSid;
        $this->options['lastConsumedMessageIndex'] = $lastConsumedMessageIndex;
        $this->options['lastConsumptionTimestamp'] = $lastConsumptionTimestamp;
        $this->options['dateCreated'] = $dateCreated;
        $this->options['dateUpdated'] = $dateUpdated;
        $this->options['attributes'] = $attributes;
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
    }
    /**
     * The SID of the [Role](https://www.twilio.com/docs/chat/rest/role-resource) to assign to the member. The default roles are those specified on the [Service](https://www.twilio.com/docs/chat/rest/service-resource).
     *
     * @param string $roleSid The SID of the Role to assign to the member
     * @return $this Fluent Builder
     */
    public function setRoleSid(string $roleSid) : self
    {
        $this->options['roleSid'] = $roleSid;
        return $this;
    }
    /**
     * The index of the last [Message](https://www.twilio.com/docs/chat/rest/message-resource) in the [Channel](https://www.twilio.com/docs/chat/channels) that the Member has read. This parameter should only be used when recreating a Member from a backup/separate source.
     *
     * @param int $lastConsumedMessageIndex The index of the last Message in the
     *                                      Channel the Member has read
     * @return $this Fluent Builder
     */
    public function setLastConsumedMessageIndex(int $lastConsumedMessageIndex) : self
    {
        $this->options['lastConsumedMessageIndex'] = $lastConsumedMessageIndex;
        return $this;
    }
    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp of the last [Message](https://www.twilio.com/docs/chat/rest/message-resource) read event for the Member within the [Channel](https://www.twilio.com/docs/chat/channels).
     *
     * @param \DateTime $lastConsumptionTimestamp The ISO 8601 based timestamp
     *                                            string representing the datetime
     *                                            of the last Message read event
     *                                            for the member within the Channel
     * @return $this Fluent Builder
     */
    public function setLastConsumptionTimestamp(\DateTime $lastConsumptionTimestamp) : self
    {
        $this->options['lastConsumptionTimestamp'] = $lastConsumptionTimestamp;
        return $this;
    }
    /**
     * The date, specified in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format, to assign to the resource as the date it was created. The default value is the current time set by the Chat service.  Note that this parameter should only be used when a Member is being recreated from a backup/separate source.
     *
     * @param \DateTime $dateCreated The ISO 8601 date and time in GMT when the
     *                               resource was created
     * @return $this Fluent Builder
     */
    public function setDateCreated(\DateTime $dateCreated) : self
    {
        $this->options['dateCreated'] = $dateCreated;
        return $this;
    }
    /**
     * The date, specified in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format, to assign to the resource as the date it was last updated. The default value is `null`. Note that this parameter should only be used when a Member is being recreated from a backup/separate source and where a Member was previously updated.
     *
     * @param \DateTime $dateUpdated The ISO 8601 date and time in GMT when the
     *                               resource was updated
     * @return $this Fluent Builder
     */
    public function setDateUpdated(\DateTime $dateUpdated) : self
    {
        $this->options['dateUpdated'] = $dateUpdated;
        return $this;
    }
    /**
     * A valid JSON string that contains application-specific data.
     *
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes) : self
    {
        $this->options['attributes'] = $attributes;
        return $this;
    }
    /**
     * The X-Twilio-Webhook-Enabled HTTP request header
     *
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return $this Fluent Builder
     */
    public function setXTwilioWebhookEnabled(string $xTwilioWebhookEnabled) : self
    {
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
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
        return '[Twilio.Chat.V2.CreateMemberOptions ' . $options . ']';
    }
}
class ReadMemberOptions extends Options
{
    /**
     * @param string[] $identity The `identity` value of the resources to read
     */
    public function __construct(array $identity = Values::ARRAY_NONE)
    {
        $this->options['identity'] = $identity;
    }
    /**
     * The [User](https://www.twilio.com/docs/chat/rest/user-resource)'s `identity` value of the Member resources to read. See [access tokens](https://www.twilio.com/docs/chat/create-tokens) for more details.
     *
     * @param string[] $identity The `identity` value of the resources to read
     * @return $this Fluent Builder
     */
    public function setIdentity(array $identity) : self
    {
        $this->options['identity'] = $identity;
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
        return '[Twilio.Chat.V2.ReadMemberOptions ' . $options . ']';
    }
}
class DeleteMemberOptions extends Options
{
    /**
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     */
    public function __construct(string $xTwilioWebhookEnabled = Values::NONE)
    {
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
    }
    /**
     * The X-Twilio-Webhook-Enabled HTTP request header
     *
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return $this Fluent Builder
     */
    public function setXTwilioWebhookEnabled(string $xTwilioWebhookEnabled) : self
    {
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
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
        return '[Twilio.Chat.V2.DeleteMemberOptions ' . $options . ']';
    }
}
class UpdateMemberOptions extends Options
{
    /**
     * @param string $roleSid The SID of the Role to assign to the member
     * @param int $lastConsumedMessageIndex The index of the last consumed Message
     *                                      for the Channel for the Member
     * @param \DateTime $lastConsumptionTimestamp The ISO 8601 based timestamp
     *                                            string representing the datetime
     *                                            of the last Message read event
     *                                            for the Member within the Channel
     * @param \DateTime $dateCreated The ISO 8601 date and time in GMT when the
     *                               resource was created
     * @param \DateTime $dateUpdated The ISO 8601 date and time in GMT when the
     *                               resource was updated
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     */
    public function __construct(string $roleSid = Values::NONE, int $lastConsumedMessageIndex = Values::NONE, \DateTime $lastConsumptionTimestamp = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $attributes = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE)
    {
        $this->options['roleSid'] = $roleSid;
        $this->options['lastConsumedMessageIndex'] = $lastConsumedMessageIndex;
        $this->options['lastConsumptionTimestamp'] = $lastConsumptionTimestamp;
        $this->options['dateCreated'] = $dateCreated;
        $this->options['dateUpdated'] = $dateUpdated;
        $this->options['attributes'] = $attributes;
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
    }
    /**
     * The SID of the [Role](https://www.twilio.com/docs/chat/rest/role-resource) to assign to the member. The default roles are those specified on the [Service](https://www.twilio.com/docs/chat/rest/service-resource).
     *
     * @param string $roleSid The SID of the Role to assign to the member
     * @return $this Fluent Builder
     */
    public function setRoleSid(string $roleSid) : self
    {
        $this->options['roleSid'] = $roleSid;
        return $this;
    }
    /**
     * The index of the last [Message](https://www.twilio.com/docs/chat/rest/message-resource) that the Member has read within the [Channel](https://www.twilio.com/docs/chat/channels).
     *
     * @param int $lastConsumedMessageIndex The index of the last consumed Message
     *                                      for the Channel for the Member
     * @return $this Fluent Builder
     */
    public function setLastConsumedMessageIndex(int $lastConsumedMessageIndex) : self
    {
        $this->options['lastConsumedMessageIndex'] = $lastConsumedMessageIndex;
        return $this;
    }
    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp of the last [Message](https://www.twilio.com/docs/chat/rest/message-resource) read event for the Member within the [Channel](https://www.twilio.com/docs/chat/channels).
     *
     * @param \DateTime $lastConsumptionTimestamp The ISO 8601 based timestamp
     *                                            string representing the datetime
     *                                            of the last Message read event
     *                                            for the Member within the Channel
     * @return $this Fluent Builder
     */
    public function setLastConsumptionTimestamp(\DateTime $lastConsumptionTimestamp) : self
    {
        $this->options['lastConsumptionTimestamp'] = $lastConsumptionTimestamp;
        return $this;
    }
    /**
     * The date, specified in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format, to assign to the resource as the date it was created. The default value is the current time set by the Chat service.  Note that this parameter should only be used when a Member is being recreated from a backup/separate source.
     *
     * @param \DateTime $dateCreated The ISO 8601 date and time in GMT when the
     *                               resource was created
     * @return $this Fluent Builder
     */
    public function setDateCreated(\DateTime $dateCreated) : self
    {
        $this->options['dateCreated'] = $dateCreated;
        return $this;
    }
    /**
     * The date, specified in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format, to assign to the resource as the date it was last updated.
     *
     * @param \DateTime $dateUpdated The ISO 8601 date and time in GMT when the
     *                               resource was updated
     * @return $this Fluent Builder
     */
    public function setDateUpdated(\DateTime $dateUpdated) : self
    {
        $this->options['dateUpdated'] = $dateUpdated;
        return $this;
    }
    /**
     * A valid JSON string that contains application-specific data.
     *
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes) : self
    {
        $this->options['attributes'] = $attributes;
        return $this;
    }
    /**
     * The X-Twilio-Webhook-Enabled HTTP request header
     *
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return $this Fluent Builder
     */
    public function setXTwilioWebhookEnabled(string $xTwilioWebhookEnabled) : self
    {
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
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
        return '[Twilio.Chat.V2.UpdateMemberOptions ' . $options . ']';
    }
}
