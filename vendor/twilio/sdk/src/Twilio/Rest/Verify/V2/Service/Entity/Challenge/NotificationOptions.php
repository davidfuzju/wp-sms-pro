<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Verify\V2\Service\Entity\Challenge;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class NotificationOptions
{
    /**
     * @param int $ttl How long, in seconds, the notification is valid.
     * @return CreateNotificationOptions Options builder
     */
    public static function create(int $ttl = Values::NONE) : CreateNotificationOptions
    {
        return new CreateNotificationOptions($ttl);
    }
}
class CreateNotificationOptions extends Options
{
    /**
     * @param int $ttl How long, in seconds, the notification is valid.
     */
    public function __construct(int $ttl = Values::NONE)
    {
        $this->options['ttl'] = $ttl;
    }
    /**
     * How long, in seconds, the notification is valid. Can be an integer between 0 and 300. Default is 300. Delivery is attempted until the TTL elapses, even if the device is offline. 0 means that the notification delivery is attempted immediately, only once, and is not stored for future delivery.
     *
     * @param int $ttl How long, in seconds, the notification is valid.
     * @return $this Fluent Builder
     */
    public function setTtl(int $ttl) : self
    {
        $this->options['ttl'] = $ttl;
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
        return '[Twilio.Verify.V2.CreateNotificationOptions ' . $options . ']';
    }
}
