<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Messaging\V1;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Rest\Messaging\V1\BrandRegistration\BrandVettingList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property string $sid
 * @property string $accountSid
 * @property string $customerProfileBundleSid
 * @property string $a2PProfileBundleSid
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $brandType
 * @property string $status
 * @property string $tcrId
 * @property string $failureReason
 * @property string $url
 * @property int $brandScore
 * @property string[] $brandFeedback
 * @property string $identityStatus
 * @property bool $russell3000
 * @property bool $governmentEntity
 * @property string $taxExemptStatus
 * @property bool $skipAutomaticSecVet
 * @property bool $mock
 * @property array $links
 */
class BrandRegistrationInstance extends InstanceResource
{
    protected $_brandVettings;
    /**
     * Initialize the BrandRegistrationInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function __construct(Version $version, array $payload, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['sid' => Values::array_get($payload, 'sid'), 'accountSid' => Values::array_get($payload, 'account_sid'), 'customerProfileBundleSid' => Values::array_get($payload, 'customer_profile_bundle_sid'), 'a2PProfileBundleSid' => Values::array_get($payload, 'a2p_profile_bundle_sid'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')), 'brandType' => Values::array_get($payload, 'brand_type'), 'status' => Values::array_get($payload, 'status'), 'tcrId' => Values::array_get($payload, 'tcr_id'), 'failureReason' => Values::array_get($payload, 'failure_reason'), 'url' => Values::array_get($payload, 'url'), 'brandScore' => Values::array_get($payload, 'brand_score'), 'brandFeedback' => Values::array_get($payload, 'brand_feedback'), 'identityStatus' => Values::array_get($payload, 'identity_status'), 'russell3000' => Values::array_get($payload, 'russell_3000'), 'governmentEntity' => Values::array_get($payload, 'government_entity'), 'taxExemptStatus' => Values::array_get($payload, 'tax_exempt_status'), 'skipAutomaticSecVet' => Values::array_get($payload, 'skip_automatic_sec_vet'), 'mock' => Values::array_get($payload, 'mock'), 'links' => Values::array_get($payload, 'links')];
        $this->solution = ['sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return BrandRegistrationContext Context for this BrandRegistrationInstance
     */
    protected function proxy() : BrandRegistrationContext
    {
        if (!$this->context) {
            $this->context = new BrandRegistrationContext($this->version, $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the BrandRegistrationInstance
     *
     * @return BrandRegistrationInstance Fetched BrandRegistrationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : BrandRegistrationInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Update the BrandRegistrationInstance
     *
     * @return BrandRegistrationInstance Updated BrandRegistrationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update() : BrandRegistrationInstance
    {
        return $this->proxy()->update();
    }
    /**
     * Access the brandVettings
     */
    protected function getBrandVettings() : BrandVettingList
    {
        return $this->proxy()->brandVettings;
    }
    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->{$method}();
        }
        throw new TwilioException('Unknown property: ' . $name);
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
        return '[Twilio.Messaging.V1.BrandRegistrationInstance ' . \implode(' ', $context) . ']';
    }
}
