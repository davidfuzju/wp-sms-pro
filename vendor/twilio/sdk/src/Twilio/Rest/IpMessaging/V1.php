<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\IpMessaging;

use WPSmsPro\Vendor\Twilio\Domain;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Rest\IpMessaging\V1\CredentialList;
use WPSmsPro\Vendor\Twilio\Rest\IpMessaging\V1\ServiceList;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property CredentialList $credentials
 * @property ServiceList $services
 * @method \Twilio\Rest\IpMessaging\V1\CredentialContext credentials(string $sid)
 * @method \Twilio\Rest\IpMessaging\V1\ServiceContext services(string $sid)
 */
class V1 extends Version
{
    protected $_credentials;
    protected $_services;
    /**
     * Construct the V1 version of IpMessaging
     *
     * @param Domain $domain Domain that contains the version
     */
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
        $this->version = 'v1';
    }
    protected function getCredentials() : CredentialList
    {
        if (!$this->_credentials) {
            $this->_credentials = new CredentialList($this);
        }
        return $this->_credentials;
    }
    protected function getServices() : ServiceList
    {
        if (!$this->_services) {
            $this->_services = new ServiceList($this);
        }
        return $this->_services;
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
        return '[Twilio.IpMessaging.V1]';
    }
}
