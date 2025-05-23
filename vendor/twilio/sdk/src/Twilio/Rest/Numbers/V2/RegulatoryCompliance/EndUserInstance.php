<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Numbers\V2\RegulatoryCompliance;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $sid
 * @property string $accountSid
 * @property string $friendlyName
 * @property string $type
 * @property array $attributes
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $url
 */
class EndUserInstance extends InstanceResource
{
    /**
     * Initialize the EndUserInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, array $payload, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['sid' => Values::array_get($payload, 'sid'), 'accountSid' => Values::array_get($payload, 'account_sid'), 'friendlyName' => Values::array_get($payload, 'friendly_name'), 'type' => Values::array_get($payload, 'type'), 'attributes' => Values::array_get($payload, 'attributes'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')), 'url' => Values::array_get($payload, 'url')];
        $this->solution = ['sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return EndUserContext Context for this EndUserInstance
     */
    protected function proxy() : EndUserContext
    {
        if (!$this->context) {
            $this->context = new EndUserContext($this->version, $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the EndUserInstance
     *
     * @return EndUserInstance Fetched EndUserInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : EndUserInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Update the EndUserInstance
     *
     * @param array|Options $options Optional Arguments
     * @return EndUserInstance Updated EndUserInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : EndUserInstance
    {
        return $this->proxy()->update($options);
    }
    /**
     * Delete the EndUserInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->proxy()->delete();
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
        return '[Twilio.Numbers.V2.EndUserInstance ' . \implode(' ', $context) . ']';
    }
}
