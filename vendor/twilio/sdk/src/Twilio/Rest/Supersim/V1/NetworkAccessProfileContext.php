<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Supersim\V1;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Rest\Supersim\V1\NetworkAccessProfile\NetworkAccessProfileNetworkList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property NetworkAccessProfileNetworkList $networks
 * @method \Twilio\Rest\Supersim\V1\NetworkAccessProfile\NetworkAccessProfileNetworkContext networks(string $sid)
 */
class NetworkAccessProfileContext extends InstanceContext
{
    protected $_networks;
    /**
     * Initialize the NetworkAccessProfileContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function __construct(Version $version, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['sid' => $sid];
        $this->uri = '/NetworkAccessProfiles/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the NetworkAccessProfileInstance
     *
     * @return NetworkAccessProfileInstance Fetched NetworkAccessProfileInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : NetworkAccessProfileInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new NetworkAccessProfileInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Update the NetworkAccessProfileInstance
     *
     * @param array|Options $options Optional Arguments
     * @return NetworkAccessProfileInstance Updated NetworkAccessProfileInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : NetworkAccessProfileInstance
    {
        $options = new Values($options);
        $data = Values::of(['UniqueName' => $options['uniqueName']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new NetworkAccessProfileInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Access the networks
     */
    protected function getNetworks() : NetworkAccessProfileNetworkList
    {
        if (!$this->_networks) {
            $this->_networks = new NetworkAccessProfileNetworkList($this->version, $this->solution['sid']);
        }
        return $this->_networks;
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
        return '[Twilio.Supersim.V1.NetworkAccessProfileContext ' . \implode(' ', $context) . ']';
    }
}
