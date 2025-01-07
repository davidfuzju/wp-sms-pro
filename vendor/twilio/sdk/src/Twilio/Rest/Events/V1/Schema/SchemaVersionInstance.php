<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Events\V1\Schema;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property string $id
 * @property int $schemaVersion
 * @property \DateTime $dateCreated
 * @property string $url
 * @property string $raw
 */
class SchemaVersionInstance extends InstanceResource
{
    /**
     * Initialize the SchemaVersionInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $id The unique identifier of the schema.
     * @param int $schemaVersion The version of the schema
     */
    public function __construct(Version $version, array $payload, string $id, int $schemaVersion = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['id' => Values::array_get($payload, 'id'), 'schemaVersion' => Values::array_get($payload, 'schema_version'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'url' => Values::array_get($payload, 'url'), 'raw' => Values::array_get($payload, 'raw')];
        $this->solution = ['id' => $id, 'schemaVersion' => $schemaVersion ?: $this->properties['schemaVersion']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return SchemaVersionContext Context for this SchemaVersionInstance
     */
    protected function proxy() : SchemaVersionContext
    {
        if (!$this->context) {
            $this->context = new SchemaVersionContext($this->version, $this->solution['id'], $this->solution['schemaVersion']);
        }
        return $this->context;
    }
    /**
     * Fetch the SchemaVersionInstance
     *
     * @return SchemaVersionInstance Fetched SchemaVersionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : SchemaVersionInstance
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
        return '[Twilio.Events.V1.SchemaVersionInstance ' . \implode(' ', $context) . ']';
    }
}
