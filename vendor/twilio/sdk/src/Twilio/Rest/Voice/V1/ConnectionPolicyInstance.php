<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Voice\V1;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Rest\Voice\V1\ConnectionPolicy\ConnectionPolicyTargetList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $accountSid
 * @property string $sid
 * @property string $friendlyName
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $url
 * @property array $links
 */
class ConnectionPolicyInstance extends InstanceResource
{
    protected $_targets;
    /**
     * Initialize the ConnectionPolicyInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, array $payload, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'sid' => Values::array_get($payload, 'sid'), 'friendlyName' => Values::array_get($payload, 'friendly_name'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')), 'url' => Values::array_get($payload, 'url'), 'links' => Values::array_get($payload, 'links')];
        $this->solution = ['sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return ConnectionPolicyContext Context for this ConnectionPolicyInstance
     */
    protected function proxy() : ConnectionPolicyContext
    {
        if (!$this->context) {
            $this->context = new ConnectionPolicyContext($this->version, $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the ConnectionPolicyInstance
     *
     * @return ConnectionPolicyInstance Fetched ConnectionPolicyInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : ConnectionPolicyInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Update the ConnectionPolicyInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ConnectionPolicyInstance Updated ConnectionPolicyInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : ConnectionPolicyInstance
    {
        return $this->proxy()->update($options);
    }
    /**
     * Delete the ConnectionPolicyInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->proxy()->delete();
    }
    /**
     * Access the targets
     */
    protected function getTargets() : ConnectionPolicyTargetList
    {
        return $this->proxy()->targets;
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
        return '[Twilio.Voice.V1.ConnectionPolicyInstance ' . \implode(' ', $context) . ']';
    }
}
