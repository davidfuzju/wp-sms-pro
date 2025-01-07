<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Bulkexports\V1;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Rest\Bulkexports\V1\Export\DayList;
use WPSmsPro\Vendor\Twilio\Rest\Bulkexports\V1\Export\ExportCustomJobList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $resourceType
 * @property string $url
 * @property array $links
 */
class ExportInstance extends InstanceResource
{
    protected $_days;
    protected $_exportCustomJobs;
    /**
     * Initialize the ExportInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $resourceType The type of communication – Messages, Calls,
     *                             Conferences, and Participants
     */
    public function __construct(Version $version, array $payload, string $resourceType = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['resourceType' => Values::array_get($payload, 'resource_type'), 'url' => Values::array_get($payload, 'url'), 'links' => Values::array_get($payload, 'links')];
        $this->solution = ['resourceType' => $resourceType ?: $this->properties['resourceType']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return ExportContext Context for this ExportInstance
     */
    protected function proxy() : ExportContext
    {
        if (!$this->context) {
            $this->context = new ExportContext($this->version, $this->solution['resourceType']);
        }
        return $this->context;
    }
    /**
     * Fetch the ExportInstance
     *
     * @return ExportInstance Fetched ExportInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : ExportInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Access the days
     */
    protected function getDays() : DayList
    {
        return $this->proxy()->days;
    }
    /**
     * Access the exportCustomJobs
     */
    protected function getExportCustomJobs() : ExportCustomJobList
    {
        return $this->proxy()->exportCustomJobs;
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
        return '[Twilio.Bulkexports.V1.ExportInstance ' . \implode(' ', $context) . ']';
    }
}
