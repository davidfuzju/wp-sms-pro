<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Events\V1;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Rest\Events\V1\Subscription\SubscribedEventList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property string $accountSid
 * @property string $sid
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $description
 * @property string $sinkSid
 * @property string $url
 * @property array $links
 */
class SubscriptionInstance extends InstanceResource
{
    protected $_subscribedEvents;
    /**
     * Initialize the SubscriptionInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid A string that uniquely identifies this Subscription.
     */
    public function __construct(Version $version, array $payload, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'sid' => Values::array_get($payload, 'sid'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')), 'description' => Values::array_get($payload, 'description'), 'sinkSid' => Values::array_get($payload, 'sink_sid'), 'url' => Values::array_get($payload, 'url'), 'links' => Values::array_get($payload, 'links')];
        $this->solution = ['sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return SubscriptionContext Context for this SubscriptionInstance
     */
    protected function proxy() : SubscriptionContext
    {
        if (!$this->context) {
            $this->context = new SubscriptionContext($this->version, $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the SubscriptionInstance
     *
     * @return SubscriptionInstance Fetched SubscriptionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : SubscriptionInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Update the SubscriptionInstance
     *
     * @param array|Options $options Optional Arguments
     * @return SubscriptionInstance Updated SubscriptionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : SubscriptionInstance
    {
        return $this->proxy()->update($options);
    }
    /**
     * Delete the SubscriptionInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->proxy()->delete();
    }
    /**
     * Access the subscribedEvents
     */
    protected function getSubscribedEvents() : SubscribedEventList
    {
        return $this->proxy()->subscribedEvents;
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
        return '[Twilio.Events.V1.SubscriptionInstance ' . \implode(' ', $context) . ']';
    }
}
