<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Taskrouter\V1\Workspace;

use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Version;
class WorkspaceStatisticsList extends ListResource
{
    /**
     * Construct the WorkspaceStatisticsList
     *
     * @param Version $version Version that contains the resource
     * @param string $workspaceSid The SID of the Workspace
     */
    public function __construct(Version $version, string $workspaceSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['workspaceSid' => $workspaceSid];
    }
    /**
     * Constructs a WorkspaceStatisticsContext
     */
    public function getContext() : WorkspaceStatisticsContext
    {
        return new WorkspaceStatisticsContext($this->version, $this->solution['workspaceSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Taskrouter.V1.WorkspaceStatisticsList]';
    }
}
