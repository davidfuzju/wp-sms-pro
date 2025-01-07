<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\IncomingPhoneNumber\AssignedAddOnList;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property AssignedAddOnList $assignedAddOns
 * @method \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumber\AssignedAddOnContext assignedAddOns(string $sid)
 */
class IncomingPhoneNumberContext extends InstanceContext
{
    protected $_assignedAddOns;
    /**
     * Initialize the IncomingPhoneNumberContext
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the Account that created the resource
     *                           to fetch
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $accountSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['accountSid' => $accountSid, 'sid' => $sid];
        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/IncomingPhoneNumbers/' . \rawurlencode($sid) . '.json';
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
        $options = new Values($options);
        $data = Values::of(['AccountSid' => $options['accountSid'], 'ApiVersion' => $options['apiVersion'], 'FriendlyName' => $options['friendlyName'], 'SmsApplicationSid' => $options['smsApplicationSid'], 'SmsFallbackMethod' => $options['smsFallbackMethod'], 'SmsFallbackUrl' => $options['smsFallbackUrl'], 'SmsMethod' => $options['smsMethod'], 'SmsUrl' => $options['smsUrl'], 'StatusCallback' => $options['statusCallback'], 'StatusCallbackMethod' => $options['statusCallbackMethod'], 'VoiceApplicationSid' => $options['voiceApplicationSid'], 'VoiceCallerIdLookup' => Serialize::booleanToString($options['voiceCallerIdLookup']), 'VoiceFallbackMethod' => $options['voiceFallbackMethod'], 'VoiceFallbackUrl' => $options['voiceFallbackUrl'], 'VoiceMethod' => $options['voiceMethod'], 'VoiceUrl' => $options['voiceUrl'], 'EmergencyStatus' => $options['emergencyStatus'], 'EmergencyAddressSid' => $options['emergencyAddressSid'], 'TrunkSid' => $options['trunkSid'], 'VoiceReceiveMode' => $options['voiceReceiveMode'], 'IdentitySid' => $options['identitySid'], 'AddressSid' => $options['addressSid'], 'BundleSid' => $options['bundleSid']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new IncomingPhoneNumberInstance($this->version, $payload, $this->solution['accountSid'], $this->solution['sid']);
    }
    /**
     * Fetch the IncomingPhoneNumberInstance
     *
     * @return IncomingPhoneNumberInstance Fetched IncomingPhoneNumberInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : IncomingPhoneNumberInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new IncomingPhoneNumberInstance($this->version, $payload, $this->solution['accountSid'], $this->solution['sid']);
    }
    /**
     * Delete the IncomingPhoneNumberInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Access the assignedAddOns
     */
    protected function getAssignedAddOns() : AssignedAddOnList
    {
        if (!$this->_assignedAddOns) {
            $this->_assignedAddOns = new AssignedAddOnList($this->version, $this->solution['accountSid'], $this->solution['sid']);
        }
        return $this->_assignedAddOns;
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
        return '[Twilio.Api.V2010.IncomingPhoneNumberContext ' . \implode(' ', $context) . ']';
    }
}
