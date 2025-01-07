<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\BulkExports\Export;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $friendlyName
 * @property string $resourceType
 * @property string $startDay
 * @property string $endDay
 * @property string $webhookUrl
 * @property string $webhookMethod
 * @property string $email
 * @property string $jobSid
 * @property array $details
 */
class ExportCustomJobInstance extends InstanceResource
{
    /**
     * Initialize the ExportCustomJobInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $resourceType The type of communication – Messages, Calls,
     *                             Conferences, and Participants
     */
    public function __construct(Version $version, array $payload, string $resourceType)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['friendlyName' => Values::array_get($payload, 'friendly_name'), 'resourceType' => Values::array_get($payload, 'resource_type'), 'startDay' => Values::array_get($payload, 'start_day'), 'endDay' => Values::array_get($payload, 'end_day'), 'webhookUrl' => Values::array_get($payload, 'webhook_url'), 'webhookMethod' => Values::array_get($payload, 'webhook_method'), 'email' => Values::array_get($payload, 'email'), 'jobSid' => Values::array_get($payload, 'job_sid'), 'details' => Values::array_get($payload, 'details')];
        $this->solution = ['resourceType' => $resourceType];
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
        return '[Twilio.Preview.BulkExports.ExportCustomJobInstance]';
    }
}
