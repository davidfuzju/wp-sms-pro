<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Bulkexports\V1\Export;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $redirectTo
 * @property string $day
 * @property int $size
 * @property string $createDate
 * @property string $friendlyName
 * @property string $resourceType
 */
class DayInstance extends InstanceResource
{
    /**
     * Initialize the DayInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $resourceType The type of communication – Messages, Calls,
     *                             Conferences, and Participants
     * @param string $day The date of the data in the file
     */
    public function __construct(Version $version, array $payload, string $resourceType, string $day = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['redirectTo' => Values::array_get($payload, 'redirect_to'), 'day' => Values::array_get($payload, 'day'), 'size' => Values::array_get($payload, 'size'), 'createDate' => Values::array_get($payload, 'create_date'), 'friendlyName' => Values::array_get($payload, 'friendly_name'), 'resourceType' => Values::array_get($payload, 'resource_type')];
        $this->solution = ['resourceType' => $resourceType, 'day' => $day ?: $this->properties['day']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return DayContext Context for this DayInstance
     */
    protected function proxy() : DayContext
    {
        if (!$this->context) {
            $this->context = new DayContext($this->version, $this->solution['resourceType'], $this->solution['day']);
        }
        return $this->context;
    }
    /**
     * Fetch the DayInstance
     *
     * @return DayInstance Fetched DayInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : DayInstance
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
        return '[Twilio.Bulkexports.V1.DayInstance ' . \implode(' ', $context) . ']';
    }
}
