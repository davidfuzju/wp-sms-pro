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
use WPSmsPro\Vendor\Twilio\Rest\Preview\HostedNumbers\AuthorizationDocumentList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\HostedNumbers\HostedNumberOrderList;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property AuthorizationDocumentList $authorizationDocuments
 * @property HostedNumberOrderList $hostedNumberOrders
 * @method \Twilio\Rest\Preview\HostedNumbers\AuthorizationDocumentContext authorizationDocuments(string $sid)
 * @method \Twilio\Rest\Preview\HostedNumbers\HostedNumberOrderContext hostedNumberOrders(string $sid)
 */
class HostedNumbers extends Version
{
    protected $_authorizationDocuments;
    protected $_hostedNumberOrders;
    /**
     * Construct the HostedNumbers version of Preview
     *
     * @param Domain $domain Domain that contains the version
     */
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
        $this->version = 'HostedNumbers';
    }
    protected function getAuthorizationDocuments() : AuthorizationDocumentList
    {
        if (!$this->_authorizationDocuments) {
            $this->_authorizationDocuments = new AuthorizationDocumentList($this);
        }
        return $this->_authorizationDocuments;
    }
    protected function getHostedNumberOrders() : HostedNumberOrderList
    {
        if (!$this->_hostedNumberOrders) {
            $this->_hostedNumberOrders = new HostedNumberOrderList($this);
        }
        return $this->_hostedNumberOrders;
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
        return '[Twilio.Preview.HostedNumbers]';
    }
}
