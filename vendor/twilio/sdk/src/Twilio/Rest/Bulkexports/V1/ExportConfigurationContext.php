<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Bulkexports\V1;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class ExportConfigurationContext extends InstanceContext
{
    /**
     * Initialize the ExportConfigurationContext
     *
     * @param Version $version Version that contains the resource
     * @param string $resourceType The type of communication – Messages, Calls,
     *                             Conferences, and Participants
     */
    public function __construct(Version $version, $resourceType)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['resourceType' => $resourceType];
        $this->uri = '/Exports/' . \rawurlencode($resourceType) . '/Configuration';
    }
    /**
     * Fetch the ExportConfigurationInstance
     *
     * @return ExportConfigurationInstance Fetched ExportConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : ExportConfigurationInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new ExportConfigurationInstance($this->version, $payload, $this->solution['resourceType']);
    }
    /**
     * Update the ExportConfigurationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ExportConfigurationInstance Updated ExportConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : ExportConfigurationInstance
    {
        $options = new Values($options);
        $data = Values::of(['Enabled' => Serialize::booleanToString($options['enabled']), 'WebhookUrl' => $options['webhookUrl'], 'WebhookMethod' => $options['webhookMethod']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new ExportConfigurationInstance($this->version, $payload, $this->solution['resourceType']);
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
        return '[Twilio.Bulkexports.V1.ExportConfigurationContext ' . \implode(' ', $context) . ']';
    }
}
