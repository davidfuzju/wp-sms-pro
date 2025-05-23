<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Messaging;

use WPSmsPro\Vendor\Twilio\Domain;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Rest\Messaging\V1\BrandRegistrationList;
use WPSmsPro\Vendor\Twilio\Rest\Messaging\V1\DeactivationsList;
use WPSmsPro\Vendor\Twilio\Rest\Messaging\V1\ExternalCampaignList;
use WPSmsPro\Vendor\Twilio\Rest\Messaging\V1\ServiceList;
use WPSmsPro\Vendor\Twilio\Rest\Messaging\V1\UsecaseList;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property BrandRegistrationList $brandRegistrations
 * @property DeactivationsList $deactivations
 * @property ExternalCampaignList $externalCampaign
 * @property ServiceList $services
 * @property UsecaseList $usecases
 * @method \Twilio\Rest\Messaging\V1\BrandRegistrationContext brandRegistrations(string $sid)
 * @method \Twilio\Rest\Messaging\V1\ServiceContext services(string $sid)
 */
class V1 extends Version
{
    protected $_brandRegistrations;
    protected $_deactivations;
    protected $_externalCampaign;
    protected $_services;
    protected $_usecases;
    /**
     * Construct the V1 version of Messaging
     *
     * @param Domain $domain Domain that contains the version
     */
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
        $this->version = 'v1';
    }
    protected function getBrandRegistrations() : BrandRegistrationList
    {
        if (!$this->_brandRegistrations) {
            $this->_brandRegistrations = new BrandRegistrationList($this);
        }
        return $this->_brandRegistrations;
    }
    protected function getDeactivations() : DeactivationsList
    {
        if (!$this->_deactivations) {
            $this->_deactivations = new DeactivationsList($this);
        }
        return $this->_deactivations;
    }
    protected function getExternalCampaign() : ExternalCampaignList
    {
        if (!$this->_externalCampaign) {
            $this->_externalCampaign = new ExternalCampaignList($this);
        }
        return $this->_externalCampaign;
    }
    protected function getServices() : ServiceList
    {
        if (!$this->_services) {
            $this->_services = new ServiceList($this);
        }
        return $this->_services;
    }
    protected function getUsecases() : UsecaseList
    {
        if (!$this->_usecases) {
            $this->_usecases = new UsecaseList($this);
        }
        return $this->_usecases;
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
        return '[Twilio.Messaging.V1]';
    }
}
