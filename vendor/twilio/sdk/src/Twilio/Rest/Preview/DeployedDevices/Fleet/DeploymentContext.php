<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\DeployedDevices\Fleet;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class DeploymentContext extends InstanceContext
{
    /**
     * Initialize the DeploymentContext
     *
     * @param Version $version Version that contains the resource
     * @param string $fleetSid The fleet_sid
     * @param string $sid A string that uniquely identifies the Deployment.
     */
    public function __construct(Version $version, $fleetSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['fleetSid' => $fleetSid, 'sid' => $sid];
        $this->uri = '/Fleets/' . \rawurlencode($fleetSid) . '/Deployments/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the DeploymentInstance
     *
     * @return DeploymentInstance Fetched DeploymentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : DeploymentInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new DeploymentInstance($this->version, $payload, $this->solution['fleetSid'], $this->solution['sid']);
    }
    /**
     * Delete the DeploymentInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Update the DeploymentInstance
     *
     * @param array|Options $options Optional Arguments
     * @return DeploymentInstance Updated DeploymentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : DeploymentInstance
    {
        $options = new Values($options);
        $data = Values::of(['FriendlyName' => $options['friendlyName'], 'SyncServiceSid' => $options['syncServiceSid']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new DeploymentInstance($this->version, $payload, $this->solution['fleetSid'], $this->solution['sid']);
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
        return '[Twilio.Preview.DeployedDevices.DeploymentContext ' . \implode(' ', $context) . ']';
    }
}
