<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Events\V1;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Rest\Events\V1\Schema\SchemaVersionList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property SchemaVersionList $versions
 * @method \Twilio\Rest\Events\V1\Schema\SchemaVersionContext versions(int $schemaVersion)
 */
class SchemaContext extends InstanceContext
{
    protected $_versions;
    /**
     * Initialize the SchemaContext
     *
     * @param Version $version Version that contains the resource
     * @param string $id The unique identifier of the schema.
     */
    public function __construct(Version $version, $id)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['id' => $id];
        $this->uri = '/Schemas/' . \rawurlencode($id) . '';
    }
    /**
     * Fetch the SchemaInstance
     *
     * @return SchemaInstance Fetched SchemaInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : SchemaInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new SchemaInstance($this->version, $payload, $this->solution['id']);
    }
    /**
     * Access the versions
     */
    protected function getVersions() : SchemaVersionList
    {
        if (!$this->_versions) {
            $this->_versions = new SchemaVersionList($this->version, $this->solution['id']);
        }
        return $this->_versions;
    }
    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get(string $name) : ListResource
    {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->{$method}();
        }
        throw new TwilioException('Unknown subresource ' . $name);
    }
    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments) : InstanceContext
    {
        $property = $this->{$name};
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }
        throw new TwilioException('Resource does not have a context');
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
        return '[Twilio.Events.V1.SchemaContext ' . \implode(' ', $context) . ']';
    }
}
