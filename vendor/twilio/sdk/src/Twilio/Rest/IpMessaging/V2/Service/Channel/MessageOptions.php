<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\IpMessaging\V2\Service\Channel;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class MessageOptions
{
    /**
     * @param string $from The from
     * @param string $attributes The attributes
     * @param \DateTime $dateCreated The date_created
     * @param \DateTime $dateUpdated The date_updated
     * @param string $lastUpdatedBy The last_updated_by
     * @param string $body The body
     * @param string $mediaSid The media_sid
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return CreateMessageOptions Options builder
     */
    public static function create(string $from = Values::NONE, string $attributes = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $lastUpdatedBy = Values::NONE, string $body = Values::NONE, string $mediaSid = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE) : CreateMessageOptions
    {
        return new CreateMessageOptions($from, $attributes, $dateCreated, $dateUpdated, $lastUpdatedBy, $body, $mediaSid, $xTwilioWebhookEnabled);
    }
    /**
     * @param string $order The order
     * @return ReadMessageOptions Options builder
     */
    public static function read(string $order = Values::NONE) : ReadMessageOptions
    {
        return new ReadMessageOptions($order);
    }
    /**
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return DeleteMessageOptions Options builder
     */
    public static function delete(string $xTwilioWebhookEnabled = Values::NONE) : DeleteMessageOptions
    {
        return new DeleteMessageOptions($xTwilioWebhookEnabled);
    }
    /**
     * @param string $body The body
     * @param string $attributes The attributes
     * @param \DateTime $dateCreated The date_created
     * @param \DateTime $dateUpdated The date_updated
     * @param string $lastUpdatedBy The last_updated_by
     * @param string $from The from
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return UpdateMessageOptions Options builder
     */
    public static function update(string $body = Values::NONE, string $attributes = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $lastUpdatedBy = Values::NONE, string $from = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE) : UpdateMessageOptions
    {
        return new UpdateMessageOptions($body, $attributes, $dateCreated, $dateUpdated, $lastUpdatedBy, $from, $xTwilioWebhookEnabled);
    }
}
class CreateMessageOptions extends Options
{
    /**
     * @param string $from The from
     * @param string $attributes The attributes
     * @param \DateTime $dateCreated The date_created
     * @param \DateTime $dateUpdated The date_updated
     * @param string $lastUpdatedBy The last_updated_by
     * @param string $body The body
     * @param string $mediaSid The media_sid
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     */
    public function __construct(string $from = Values::NONE, string $attributes = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $lastUpdatedBy = Values::NONE, string $body = Values::NONE, string $mediaSid = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE)
    {
        $this->options['from'] = $from;
        $this->options['attributes'] = $attributes;
        $this->options['dateCreated'] = $dateCreated;
        $this->options['dateUpdated'] = $dateUpdated;
        $this->options['lastUpdatedBy'] = $lastUpdatedBy;
        $this->options['body'] = $body;
        $this->options['mediaSid'] = $mediaSid;
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
    }
    /**
     * The from
     *
     * @param string $from The from
     * @return $this Fluent Builder
     */
    public function setFrom(string $from) : self
    {
        $this->options['from'] = $from;
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
     * The last_updated_by
     *
     * @param string $lastUpdatedBy The last_updated_by
     * @return $this Fluent Builder
     */
    public function setLastUpdatedBy(string $lastUpdatedBy) : self
    {
        $this->options['lastUpdatedBy'] = $lastUpdatedBy;
        return $this;
    }
    /**
     * The body
     *
     * @param string $body The body
     * @return $this Fluent Builder
     */
    public function setBody(string $body) : self
    {
        $this->options['body'] = $body;
        return $this;
    }
    /**
     * The media_sid
     *
     * @param string $mediaSid The media_sid
     * @return $this Fluent Builder
     */
    public function setMediaSid(string $mediaSid) : self
    {
        $this->options['mediaSid'] = $mediaSid;
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
        return '[Twilio.IpMessaging.V2.CreateMessageOptions ' . $options . ']';
    }
}
class ReadMessageOptions extends Options
{
    /**
     * @param string $order The order
     */
    public function __construct(string $order = Values::NONE)
    {
        $this->options['order'] = $order;
    }
    /**
     * The order
     *
     * @param string $order The order
     * @return $this Fluent Builder
     */
    public function setOrder(string $order) : self
    {
        $this->options['order'] = $order;
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
        return '[Twilio.IpMessaging.V2.ReadMessageOptions ' . $options . ']';
    }
}
class DeleteMessageOptions extends Options
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
        return '[Twilio.IpMessaging.V2.DeleteMessageOptions ' . $options . ']';
    }
}
class UpdateMessageOptions extends Options
{
    /**
     * @param string $body The body
     * @param string $attributes The attributes
     * @param \DateTime $dateCreated The date_created
     * @param \DateTime $dateUpdated The date_updated
     * @param string $lastUpdatedBy The last_updated_by
     * @param string $from The from
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     */
    public function __construct(string $body = Values::NONE, string $attributes = Values::NONE, \DateTime $dateCreated = Values::NONE, \DateTime $dateUpdated = Values::NONE, string $lastUpdatedBy = Values::NONE, string $from = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE)
    {
        $this->options['body'] = $body;
        $this->options['attributes'] = $attributes;
        $this->options['dateCreated'] = $dateCreated;
        $this->options['dateUpdated'] = $dateUpdated;
        $this->options['lastUpdatedBy'] = $lastUpdatedBy;
        $this->options['from'] = $from;
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
    }
    /**
     * The body
     *
     * @param string $body The body
     * @return $this Fluent Builder
     */
    public function setBody(string $body) : self
    {
        $this->options['body'] = $body;
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
     * The last_updated_by
     *
     * @param string $lastUpdatedBy The last_updated_by
     * @return $this Fluent Builder
     */
    public function setLastUpdatedBy(string $lastUpdatedBy) : self
    {
        $this->options['lastUpdatedBy'] = $lastUpdatedBy;
        return $this;
    }
    /**
     * The from
     *
     * @param string $from The from
     * @return $this Fluent Builder
     */
    public function setFrom(string $from) : self
    {
        $this->options['from'] = $from;
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
        return '[Twilio.IpMessaging.V2.UpdateMessageOptions ' . $options . ']';
    }
}
