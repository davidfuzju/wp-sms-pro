<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Studio\V1\Flow\Engagement;

use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Version;
class EngagementContextList extends ListResource
{
    /**
     * Construct the EngagementContextList
     *
     * @param Version $version Version that contains the resource
     * @param string $flowSid Flow SID
     * @param string $engagementSid Engagement SID
     */
    public function __construct(Version $version, string $flowSid, string $engagementSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['flowSid' => $flowSid, 'engagementSid' => $engagementSid];
    }
    /**
     * Constructs a EngagementContextContext
     */
    public function getContext() : EngagementContextContext
    {
        return new EngagementContextContext($this->version, $this->solution['flowSid'], $this->solution['engagementSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Studio.V1.EngagementContextList]';
    }
}
