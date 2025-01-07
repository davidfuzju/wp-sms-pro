<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Taskrouter\V1\Workspace\Worker;

use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Version;
class WorkersRealTimeStatisticsList extends ListResource
{
    /**
     * Construct the WorkersRealTimeStatisticsList
     *
     * @param Version $version Version that contains the resource
     * @param string $workspaceSid The SID of the Workspace that contains the
     *                             Workers
     */
    public function __construct(Version $version, string $workspaceSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['workspaceSid' => $workspaceSid];
    }
    /**
     * Constructs a WorkersRealTimeStatisticsContext
     */
    public function getContext() : WorkersRealTimeStatisticsContext
    {
        return new WorkersRealTimeStatisticsContext($this->version, $this->solution['workspaceSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Taskrouter.V1.WorkersRealTimeStatisticsList]';
    }
}
