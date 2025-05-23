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
class CertificateContext extends InstanceContext
{
    /**
     * Initialize the CertificateContext
     *
     * @param Version $version Version that contains the resource
     * @param string $fleetSid The fleet_sid
     * @param string $sid A string that uniquely identifies the Certificate.
     */
    public function __construct(Version $version, $fleetSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['fleetSid' => $fleetSid, 'sid' => $sid];
        $this->uri = '/Fleets/' . \rawurlencode($fleetSid) . '/Certificates/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the CertificateInstance
     *
     * @return CertificateInstance Fetched CertificateInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : CertificateInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new CertificateInstance($this->version, $payload, $this->solution['fleetSid'], $this->solution['sid']);
    }
    /**
     * Delete the CertificateInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Update the CertificateInstance
     *
     * @param array|Options $options Optional Arguments
     * @return CertificateInstance Updated CertificateInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : CertificateInstance
    {
        $options = new Values($options);
        $data = Values::of(['FriendlyName' => $options['friendlyName'], 'DeviceSid' => $options['deviceSid']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new CertificateInstance($this->version, $payload, $this->solution['fleetSid'], $this->solution['sid']);
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
        return '[Twilio.Preview.DeployedDevices.CertificateContext ' . \implode(' ', $context) . ']';
    }
}
