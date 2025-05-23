<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\IncomingPhoneNumber\AssignedAddOnList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $accountSid
 * @property string $addressSid
 * @property string $addressRequirements
 * @property string $apiVersion
 * @property bool $beta
 * @property string $capabilities
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $friendlyName
 * @property string $identitySid
 * @property string $phoneNumber
 * @property string $origin
 * @property string $sid
 * @property string $smsApplicationSid
 * @property string $smsFallbackMethod
 * @property string $smsFallbackUrl
 * @property string $smsMethod
 * @property string $smsUrl
 * @property string $statusCallback
 * @property string $statusCallbackMethod
 * @property string $trunkSid
 * @property string $uri
 * @property string $voiceReceiveMode
 * @property string $voiceApplicationSid
 * @property bool $voiceCallerIdLookup
 * @property string $voiceFallbackMethod
 * @property string $voiceFallbackUrl
 * @property string $voiceMethod
 * @property string $voiceUrl
 * @property string $emergencyStatus
 * @property string $emergencyAddressSid
 * @property string $emergencyAddressStatus
 * @property string $bundleSid
 * @property string $status
 */
class IncomingPhoneNumberInstance extends InstanceResource
{
    protected $_assignedAddOns;
    /**
     * Initialize the IncomingPhoneNumberInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid The SID of the Account that created the resource
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, array $payload, string $accountSid, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'addressSid' => Values::array_get($payload, 'address_sid'), 'addressRequirements' => Values::array_get($payload, 'address_requirements'), 'apiVersion' => Values::array_get($payload, 'api_version'), 'beta' => Values::array_get($payload, 'beta'), 'capabilities' => Values::array_get($payload, 'capabilities'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')), 'friendlyName' => Values::array_get($payload, 'friendly_name'), 'identitySid' => Values::array_get($payload, 'identity_sid'), 'phoneNumber' => Values::array_get($payload, 'phone_number'), 'origin' => Values::array_get($payload, 'origin'), 'sid' => Values::array_get($payload, 'sid'), 'smsApplicationSid' => Values::array_get($payload, 'sms_application_sid'), 'smsFallbackMethod' => Values::array_get($payload, 'sms_fallback_method'), 'smsFallbackUrl' => Values::array_get($payload, 'sms_fallback_url'), 'smsMethod' => Values::array_get($payload, 'sms_method'), 'smsUrl' => Values::array_get($payload, 'sms_url'), 'statusCallback' => Values::array_get($payload, 'status_callback'), 'statusCallbackMethod' => Values::array_get($payload, 'status_callback_method'), 'trunkSid' => Values::array_get($payload, 'trunk_sid'), 'uri' => Values::array_get($payload, 'uri'), 'voiceReceiveMode' => Values::array_get($payload, 'voice_receive_mode'), 'voiceApplicationSid' => Values::array_get($payload, 'voice_application_sid'), 'voiceCallerIdLookup' => Values::array_get($payload, 'voice_caller_id_lookup'), 'voiceFallbackMethod' => Values::array_get($payload, 'voice_fallback_method'), 'voiceFallbackUrl' => Values::array_get($payload, 'voice_fallback_url'), 'voiceMethod' => Values::array_get($payload, 'voice_method'), 'voiceUrl' => Values::array_get($payload, 'voice_url'), 'emergencyStatus' => Values::array_get($payload, 'emergency_status'), 'emergencyAddressSid' => Values::array_get($payload, 'emergency_address_sid'), 'emergencyAddressStatus' => Values::array_get($payload, 'emergency_address_status'), 'bundleSid' => Values::array_get($payload, 'bundle_sid'), 'status' => Values::array_get($payload, 'status')];
        $this->solution = ['accountSid' => $accountSid, 'sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return IncomingPhoneNumberContext Context for this
     *                                    IncomingPhoneNumberInstance
     */
    protected function proxy() : IncomingPhoneNumberContext
    {
        if (!$this->context) {
            $this->context = new IncomingPhoneNumberContext($this->version, $this->solution['accountSid'], $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Update the IncomingPhoneNumberInstance
     *
     * @param array|Options $options Optional Arguments
     * @return IncomingPhoneNumberInstance Updated IncomingPhoneNumberInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : IncomingPhoneNumberInstance
    {
        return $this->proxy()->update($options);
    }
    /**
     * Fetch the IncomingPhoneNumberInstance
     *
     * @return IncomingPhoneNumberInstance Fetched IncomingPhoneNumberInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : IncomingPhoneNumberInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Delete the IncomingPhoneNumberInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->proxy()->delete();
    }
    /**
     * Access the assignedAddOns
     */
    protected function getAssignedAddOns() : AssignedAddOnList
    {
        return $this->proxy()->assignedAddOns;
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
        return '[Twilio.Api.V2010.IncomingPhoneNumberInstance ' . \implode(' ', $context) . ']';
    }
}
