<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\DeployedDevices;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Rest\Preview\DeployedDevices\Fleet\CertificateList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\DeployedDevices\Fleet\DeploymentList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\DeployedDevices\Fleet\DeviceList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\DeployedDevices\Fleet\KeyList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property DeviceList $devices
 * @property DeploymentList $deployments
 * @property CertificateList $certificates
 * @property KeyList $keys
 * @method \Twilio\Rest\Preview\DeployedDevices\Fleet\DeviceContext devices(string $sid)
 * @method \Twilio\Rest\Preview\DeployedDevices\Fleet\DeploymentContext deployments(string $sid)
 * @method \Twilio\Rest\Preview\DeployedDevices\Fleet\CertificateContext certificates(string $sid)
 * @method \Twilio\Rest\Preview\DeployedDevices\Fleet\KeyContext keys(string $sid)
 */
class FleetContext extends InstanceContext
{
    protected $_devices;
    protected $_deployments;
    protected $_certificates;
    protected $_keys;
    /**
     * Initialize the FleetContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid A string that uniquely identifies the Fleet.
     */
    public function __construct(Version $version, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['sid' => $sid];
        $this->uri = '/Fleets/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the FleetInstance
     *
     * @return FleetInstance Fetched FleetInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : FleetInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new FleetInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Delete the FleetInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Update the FleetInstance
     *
     * @param array|Options $options Optional Arguments
     * @return FleetInstance Updated FleetInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : FleetInstance
    {
        $options = new Values($options);
        $data = Values::of(['FriendlyName' => $options['friendlyName'], 'DefaultDeploymentSid' => $options['defaultDeploymentSid']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new FleetInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Access the devices
     */
    protected function getDevices() : DeviceList
    {
        if (!$this->_devices) {
            $this->_devices = new DeviceList($this->version, $this->solution['sid']);
        }
        return $this->_devices;
    }
    /**
     * Access the deployments
     */
    protected function getDeployments() : DeploymentList
    {
        if (!$this->_deployments) {
            $this->_deployments = new DeploymentList($this->version, $this->solution['sid']);
        }
        return $this->_deployments;
    }
    /**
     * Access the certificates
     */
    protected function getCertificates() : CertificateList
    {
        if (!$this->_certificates) {
            $this->_certificates = new CertificateList($this->version, $this->solution['sid']);
        }
        return $this->_certificates;
    }
    /**
     * Access the keys
     */
    protected function getKeys() : KeyList
    {
        if (!$this->_keys) {
            $this->_keys = new KeyList($this->version, $this->solution['sid']);
        }
        return $this->_keys;
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
        return '[Twilio.Preview.DeployedDevices.FleetContext ' . \implode(' ', $context) . ']';
    }
}
