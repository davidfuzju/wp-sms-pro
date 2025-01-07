<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1\Conversation;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class WebhookContext extends InstanceContext
{
    /**
     * Initialize the WebhookContext
     *
     * @param Version $version Version that contains the resource
     * @param string $conversationSid The unique ID of the Conversation for this
     *                                webhook.
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    public function __construct(Version $version, $conversationSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['conversationSid' => $conversationSid, 'sid' => $sid];
        $this->uri = '/Conversations/' . \rawurlencode($conversationSid) . '/Webhooks/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the WebhookInstance
     *
     * @return WebhookInstance Fetched WebhookInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : WebhookInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new WebhookInstance($this->version, $payload, $this->solution['conversationSid'], $this->solution['sid']);
    }
    /**
     * Update the WebhookInstance
     *
     * @param array|Options $options Optional Arguments
     * @return WebhookInstance Updated WebhookInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : WebhookInstance
    {
        $options = new Values($options);
        $data = Values::of(['Configuration.Url' => $options['configurationUrl'], 'Configuration.Method' => $options['configurationMethod'], 'Configuration.Filters' => Serialize::map($options['configurationFilters'], function ($e) {
            return $e;
        }), 'Configuration.Triggers' => Serialize::map($options['configurationTriggers'], function ($e) {
            return $e;
        }), 'Configuration.FlowSid' => $options['configurationFlowSid']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new WebhookInstance($this->version, $payload, $this->solution['conversationSid'], $this->solution['sid']);
    }
    /**
     * Delete the WebhookInstance
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
        return '[Twilio.Conversations.V1.WebhookContext ' . \implode(' ', $context) . ']';
    }
}
