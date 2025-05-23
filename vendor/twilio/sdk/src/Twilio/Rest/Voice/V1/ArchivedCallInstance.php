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
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property \DateTime $date
 * @property string $sid
 * @property string $url
 */
class ArchivedCallInstance extends InstanceResource
{
    /**
     * Initialize the ArchivedCallInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param \DateTime $date The date of the Call in UTC.
     * @param string $sid The unique string that identifies this resource
     */
    public function __construct(Version $version, array $payload, \DateTime $date = null, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['date' => Deserialize::dateTime(Values::array_get($payload, 'date')), 'sid' => Values::array_get($payload, 'sid'), 'url' => Values::array_get($payload, 'url')];
        $this->solution = ['date' => $date ?: $this->properties['date'], 'sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return ArchivedCallContext Context for this ArchivedCallInstance
     */
    protected function proxy() : ArchivedCallContext
    {
        if (!$this->context) {
            $this->context = new ArchivedCallContext($this->version, $this->solution['date'], $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Delete the ArchivedCallInstance
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
        return '[Twilio.Voice.V1.ArchivedCallInstance ' . \implode(' ', $context) . ']';
    }
}
