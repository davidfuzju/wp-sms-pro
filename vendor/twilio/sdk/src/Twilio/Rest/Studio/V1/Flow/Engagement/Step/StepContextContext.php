<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Studio\V1\Flow\Engagement\Step;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class StepContextContext extends InstanceContext
{
    /**
     * Initialize the StepContextContext
     *
     * @param Version $version Version that contains the resource
     * @param string $flowSid The SID of the Flow
     * @param string $engagementSid The SID of the Engagement
     * @param string $stepSid Step SID
     */
    public function __construct(Version $version, $flowSid, $engagementSid, $stepSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['flowSid' => $flowSid, 'engagementSid' => $engagementSid, 'stepSid' => $stepSid];
        $this->uri = '/Flows/' . \rawurlencode($flowSid) . '/Engagements/' . \rawurlencode($engagementSid) . '/Steps/' . \rawurlencode($stepSid) . '/Context';
    }
    /**
     * Fetch the StepContextInstance
     *
     * @return StepContextInstance Fetched StepContextInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : StepContextInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new StepContextInstance($this->version, $payload, $this->solution['flowSid'], $this->solution['engagementSid'], $this->solution['stepSid']);
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
        return '[Twilio.Studio.V1.StepContextContext ' . \implode(' ', $context) . ']';
    }
}
