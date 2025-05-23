<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Messaging\V1;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Rest\Messaging\V1\BrandRegistration\BrandVettingList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property BrandVettingList $brandVettings
 * @method \Twilio\Rest\Messaging\V1\BrandRegistration\BrandVettingContext brandVettings(string $brandVettingSid)
 */
class BrandRegistrationContext extends InstanceContext
{
    protected $_brandVettings;
    /**
     * Initialize the BrandRegistrationContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function __construct(Version $version, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['sid' => $sid];
        $this->uri = '/a2p/BrandRegistrations/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the BrandRegistrationInstance
     *
     * @return BrandRegistrationInstance Fetched BrandRegistrationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : BrandRegistrationInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new BrandRegistrationInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Update the BrandRegistrationInstance
     *
     * @return BrandRegistrationInstance Updated BrandRegistrationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update() : BrandRegistrationInstance
    {
        $payload = $this->version->update('POST', $this->uri);
        return new BrandRegistrationInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Access the brandVettings
     */
    protected function getBrandVettings() : BrandVettingList
    {
        if (!$this->_brandVettings) {
            $this->_brandVettings = new BrandVettingList($this->version, $this->solution['sid']);
        }
        return $this->_brandVettings;
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
        return '[Twilio.Messaging.V1.BrandRegistrationContext ' . \implode(' ', $context) . ']';
    }
}
