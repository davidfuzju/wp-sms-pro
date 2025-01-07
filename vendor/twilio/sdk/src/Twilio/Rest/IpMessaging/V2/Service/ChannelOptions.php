<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\IpMessaging\V2\Service;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class ChannelOptions
{
    /**
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return DeleteChannelOptions Options builder
     */
    public static function delete(string $xTwilioWebhookEnabled = Values::NONE) : DeleteChannelOptions
    {
        return new DeleteChannelOptions($xTwilioWebhookEnabled);
    }
    /**
     * @param string $friendlyName The friendly_name
     * @param string $uniqueName The unique_name
     * @param string $attributes The attributes
     * @param string $type The type
     * @param \DateTime $dateCreated The date_created
     * @param \DateTime $dateUpdated The date_updated
     * @param string $createdBy The created_by
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return CreateChannelOptions Options builder
     */
    public static function create(string $friendlyName = Values::NONE, string $uniqueName = Values::NONE, string $attributes = Values::NONE, string $type = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $createdBy = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE) : CreateChannelOptions
    {
        return new CreateChannelOptions($friendlyName, $uniqueName, $attributes, $type, $dateCreated, $dateUpdated, $createdBy, $xTwilioWebhookEnabled);
    }
    /**
     * @param string[] $type The type
     * @return ReadChannelOptions Options builder
     */
    public static function read(array $type = Values::ARRAY_NONE) : ReadChannelOptions
    {
        return new ReadChannelOptions($type);
    }
    /**
     * @param string $friendlyName The friendly_name
     * @param string $uniqueName The unique_name
     * @param string $attributes The attributes
     * @param \DateTime $dateCreated The date_created
     * @param \DateTime $dateUpdated The date_updated
     * @param string $createdBy The created_by
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return UpdateChannelOptions Options builder
     */
    public static function update(string $friendlyName = Values::NONE, string $uniqueName = Values::NONE, string $attributes = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $createdBy = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE) : UpdateChannelOptions
    {
        return new UpdateChannelOptions($friendlyName, $uniqueName, $attributes, $dateCreated, $dateUpdated, $createdBy, $xTwilioWebhookEnabled);
    }
}
class DeleteChannelOptions extends Options
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
        return '[Twilio.IpMessaging.V2.DeleteChannelOptions ' . $options . ']';
    }
}
class CreateChannelOptions extends Options
{
    /**
     * @param string $friendlyName The friendly_name
     * @param string $uniqueName The unique_name
     * @param string $attributes The attributes
     * @param string $type The type
     * @param \DateTime $dateCreated The date_created
     * @param \DateTime $dateUpdated The date_updated
     * @param string $createdBy The created_by
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     */
    public function __construct(string $friendlyName = Values::NONE, string $uniqueName = Values::NONE, string $attributes = Values::NONE, string $type = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $createdBy = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['uniqueName'] = $uniqueName;
        $this->options['attributes'] = $attributes;
        $this->options['type'] = $type;
        $this->options['dateCreated'] = $dateCreated;
        $this->options['dateUpdated'] = $dateUpdated;
        $this->options['createdBy'] = $createdBy;
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
    }
    /**
     * The friendly_name
     *
     * @param string $friendlyName The friendly_name
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * The unique_name
     *
     * @param string $uniqueName The unique_name
     * @return $this Fluent Builder
     */
    public function setUniqueName(string $uniqueName) : self
    {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }
    /**
     * The attributes
     *
     * @param string $attributes The attributes
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes) : self
    {
        $this->options['attributes'] = $attributes;
        return $this;
    }
    /**
     * The type
     *
     * @param string $type The type
     * @return $this Fluent Builder
     */
    public function setType(string $type) : self
    {
        $this->options['type'] = $type;
        return $this;
    }
    /**
     * The date_created
     *
     * @param \DateTime $dateCreated The date_created
     * @return $this Fluent Builder
     */
    public function setDateCreated(\DateTime $dateCreated) : self
    {
        $this->options['dateCreated'] = $dateCreated;
        return $this;
    }
    /**
     * The date_updated
     *
     * @param \DateTime $dateUpdated The date_updated
     * @return $this Fluent Builder
     */
    public function setDateUpdated(\DateTime $dateUpdated) : self
    {
        $this->options['dateUpdated'] = $dateUpdated;
        return $this;
    }
    /**
     * The created_by
     *
     * @param string $createdBy The created_by
     * @return $this Fluent Builder
     */
    public function setCreatedBy(string $createdBy) : self
    {
        $this->options['createdBy'] = $createdBy;
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
        return '[Twilio.IpMessaging.V2.CreateChannelOptions ' . $options . ']';
    }
}
class ReadChannelOptions extends Options
{
    /**
     * @param string[] $type The type
     */
    public function __construct(array $type = Values::ARRAY_NONE)
    {
        $this->options['type'] = $type;
    }
    /**
     * The type
     *
     * @param string[] $type The type
     * @return $this Fluent Builder
     */
    public function setType(array $type) : self
    {
        $this->options['type'] = $type;
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
        return '[Twilio.IpMessaging.V2.ReadChannelOptions ' . $options . ']';
    }
}
class UpdateChannelOptions extends Options
{
    /**
     * @param string $friendlyName The friendly_name
     * @param string $uniqueName The unique_name
     * @param string $attributes The attributes
     * @param \DateTime $dateCreated The date_created
     * @param \DateTime $dateUpdated The date_updated
     * @param string $createdBy The created_by
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     */
    public function __construct(string $friendlyName = Values::NONE, string $uniqueName = Values::NONE, string $attributes = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $createdBy = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['uniqueName'] = $uniqueName;
        $this->options['attributes'] = $attributes;
        $this->options['dateCreated'] = $dateCreated;
        $this->options['dateUpdated'] = $dateUpdated;
        $this->options['createdBy'] = $createdBy;
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
    }
    /**
     * The friendly_name
     *
     * @param string $friendlyName The friendly_name
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * The unique_name
     *
     * @param string $uniqueName The unique_name
     * @return $this Fluent Builder
     */
    public function setUniqueName(string $uniqueName) : self
    {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }
    /**
     * The attributes
     *
     * @param string $attributes The attributes
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes) : self
    {
        $this->options['attributes'] = $attributes;
        return $this;
    }
    /**
     * The date_created
     *
     * @param \DateTime $dateCreated The date_created
     * @return $this Fluent Builder
     */
    public function setDateCreated(\DateTime $dateCreated) : self
    {
        $this->options['dateCreated'] = $dateCreated;
        return $this;
    }
    /**
     * The date_updated
     *
     * @param \DateTime $dateUpdated The date_updated
     * @return $this Fluent Builder
     */
    public function setDateUpdated(\DateTime $dateUpdated) : self
    {
        $this->options['dateUpdated'] = $dateUpdated;
        return $this;
    }
    /**
     * The created_by
     *
     * @param string $createdBy The created_by
     * @return $this Fluent Builder
     */
    public function setCreatedBy(string $createdBy) : self
    {
        $this->options['createdBy'] = $createdBy;
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
        return '[Twilio.IpMessaging.V2.UpdateChannelOptions ' . $options . ']';
    }
}
