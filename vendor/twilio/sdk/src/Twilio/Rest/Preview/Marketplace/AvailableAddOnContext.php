<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Marketplace;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Marketplace\AvailableAddOn\AvailableAddOnExtensionList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property AvailableAddOnExtensionList $extensions
 * @method \Twilio\Rest\Preview\Marketplace\AvailableAddOn\AvailableAddOnExtensionContext extensions(string $sid)
 */
class AvailableAddOnContext extends InstanceContext
{
    protected $_extensions;
    /**
     * Initialize the AvailableAddOnContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid The SID of the AvailableAddOn resource to fetch
     */
    public function __construct(Version $version, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['sid' => $sid];
        $this->uri = '/AvailableAddOns/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the AvailableAddOnInstance
     *
     * @return AvailableAddOnInstance Fetched AvailableAddOnInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : AvailableAddOnInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new AvailableAddOnInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Access the extensions
     */
    protected function getExtensions() : AvailableAddOnExtensionList
    {
        if (!$this->_extensions) {
            $this->_extensions = new AvailableAddOnExtensionList($this->version, $this->solution['sid']);
        }
        return $this->_extensions;
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
        return '[Twilio.Preview.Marketplace.AvailableAddOnContext ' . \implode(' ', $context) . ']';
    }
}
