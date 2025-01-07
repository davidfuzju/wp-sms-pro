<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Numbers\V2\RegulatoryCompliance;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $sid
 * @property string $friendlyName
 * @property string $machineName
 * @property array[] $fields
 * @property string $url
 */
class EndUserTypeInstance extends InstanceResource
{
    /**
     * Initialize the EndUserTypeInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The unique string that identifies the End-User Type
     *                    resource
     */
    public function __construct(Version $version, array $payload, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['sid' => Values::array_get($payload, 'sid'), 'friendlyName' => Values::array_get($payload, 'friendly_name'), 'machineName' => Values::array_get($payload, 'machine_name'), 'fields' => Values::array_get($payload, 'fields'), 'url' => Values::array_get($payload, 'url')];
        $this->solution = ['sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return EndUserTypeContext Context for this EndUserTypeInstance
     */
    protected function proxy() : EndUserTypeContext
    {
        if (!$this->context) {
            $this->context = new EndUserTypeContext($this->version, $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the EndUserTypeInstance
     *
     * @return EndUserTypeInstance Fetched EndUserTypeInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : EndUserTypeInstance
    {
        return $this->proxy()->fetch();
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
        return '[Twilio.Numbers.V2.EndUserTypeInstance ' . \implode(' ', $context) . ']';
    }
}
