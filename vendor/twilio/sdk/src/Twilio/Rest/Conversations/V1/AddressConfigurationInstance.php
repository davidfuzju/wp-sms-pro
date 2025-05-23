<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $sid
 * @property string $accountSid
 * @property string $type
 * @property string $address
 * @property string $friendlyName
 * @property array $autoCreation
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $url
 */
class AddressConfigurationInstance extends InstanceResource
{
    /**
     * Initialize the AddressConfigurationInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The SID or Address of the Configuration.
     */
    public function __construct(Version $version, array $payload, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['sid' => Values::array_get($payload, 'sid'), 'accountSid' => Values::array_get($payload, 'account_sid'), 'type' => Values::array_get($payload, 'type'), 'address' => Values::array_get($payload, 'address'), 'friendlyName' => Values::array_get($payload, 'friendly_name'), 'autoCreation' => Values::array_get($payload, 'auto_creation'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')), 'url' => Values::array_get($payload, 'url')];
        $this->solution = ['sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return AddressConfigurationContext Context for this
     *                                     AddressConfigurationInstance
     */
    protected function proxy() : AddressConfigurationContext
    {
        if (!$this->context) {
            $this->context = new AddressConfigurationContext($this->version, $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the AddressConfigurationInstance
     *
     * @return AddressConfigurationInstance Fetched AddressConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : AddressConfigurationInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Update the AddressConfigurationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return AddressConfigurationInstance Updated AddressConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : AddressConfigurationInstance
    {
        return $this->proxy()->update($options);
    }
    /**
     * Delete the AddressConfigurationInstance
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
        return '[Twilio.Conversations.V1.AddressConfigurationInstance ' . \implode(' ', $context) . ']';
    }
}
