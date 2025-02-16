<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview;

use WPSmsPro\Vendor\Twilio\Domain;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Marketplace\AvailableAddOnList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Marketplace\InstalledAddOnList;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property AvailableAddOnList $availableAddOns
 * @property InstalledAddOnList $installedAddOns
 * @method \Twilio\Rest\Preview\Marketplace\AvailableAddOnContext availableAddOns(string $sid)
 * @method \Twilio\Rest\Preview\Marketplace\InstalledAddOnContext installedAddOns(string $sid)
 */
class Marketplace extends Version
{
    protected $_availableAddOns;
    protected $_installedAddOns;
    /**
     * Construct the Marketplace version of Preview
     *
     * @param Domain $domain Domain that contains the version
     */
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
        $this->version = 'marketplace';
    }
    protected function getAvailableAddOns() : AvailableAddOnList
    {
        if (!$this->_availableAddOns) {
            $this->_availableAddOns = new AvailableAddOnList($this);
        }
        return $this->_availableAddOns;
    }
    protected function getInstalledAddOns() : InstalledAddOnList
    {
        if (!$this->_installedAddOns) {
            $this->_installedAddOns = new InstalledAddOnList($this);
        }
        return $this->_installedAddOns;
    }
    /**
     * Magic getter to lazy load root resources
     *
     * @param string $name Resource to return
     * @return \Twilio\ListResource The requested resource
     * @throws TwilioException For unknown resource
     */
    public function __get(string $name)
    {
        $method = 'get' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return $this->{$method}();
        }
        throw new TwilioException('Unknown resource ' . $name);
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
        return '[Twilio.Preview.Marketplace]';
    }
}
