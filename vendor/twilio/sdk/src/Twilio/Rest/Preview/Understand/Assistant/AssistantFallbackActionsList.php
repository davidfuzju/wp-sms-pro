<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant;

use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class AssistantFallbackActionsList extends ListResource
{
    /**
     * Construct the AssistantFallbackActionsList
     *
     * @param Version $version Version that contains the resource
     * @param string $assistantSid The assistant_sid
     */
    public function __construct(Version $version, string $assistantSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['assistantSid' => $assistantSid];
    }
    /**
     * Constructs a AssistantFallbackActionsContext
     */
    public function getContext() : AssistantFallbackActionsContext
    {
        return new AssistantFallbackActionsContext($this->version, $this->solution['assistantSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Preview.Understand.AssistantFallbackActionsList]';
    }
}
