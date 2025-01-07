<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class AddressConfigurationContext extends InstanceContext
{
    /**
     * Initialize the AddressConfigurationContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid The SID or Address of the Configuration.
     */
    public function __construct(Version $version, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['sid' => $sid];
        $this->uri = '/Configuration/Addresses/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the AddressConfigurationInstance
     *
     * @return AddressConfigurationInstance Fetched AddressConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : AddressConfigurationInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new AddressConfigurationInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Update the AddressConfigurationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return AddressConfigurationInstance Updated AddressConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : AddressConfigurationInstance
    {
        $options = new Values($options);
        $data = Values::of(['FriendlyName' => $options['friendlyName'], 'AutoCreation.Enabled' => Serialize::booleanToString($options['autoCreationEnabled']), 'AutoCreation.Type' => $options['autoCreationType'], 'AutoCreation.ConversationServiceSid' => $options['autoCreationConversationServiceSid'], 'AutoCreation.WebhookUrl' => $options['autoCreationWebhookUrl'], 'AutoCreation.WebhookMethod' => $options['autoCreationWebhookMethod'], 'AutoCreation.WebhookFilters' => Serialize::map($options['autoCreationWebhookFilters'], function ($e) {
            return $e;
        }), 'AutoCreation.StudioFlowSid' => $options['autoCreationStudioFlowSid'], 'AutoCreation.StudioRetryCount' => $options['autoCreationStudioRetryCount']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new AddressConfigurationInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Delete the AddressConfigurationInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
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
        return '[Twilio.Conversations.V1.AddressConfigurationContext ' . \implode(' ', $context) . ']';
    }
}
