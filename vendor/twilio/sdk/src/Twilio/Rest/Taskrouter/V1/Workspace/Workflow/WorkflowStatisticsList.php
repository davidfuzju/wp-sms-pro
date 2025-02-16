<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Taskrouter\V1\Workspace\Workflow;

use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Version;
class WorkflowStatisticsList extends ListResource
{
    /**
     * Construct the WorkflowStatisticsList
     *
     * @param Version $version Version that contains the resource
     * @param string $workspaceSid The SID of the Workspace that contains the
     *                             Workflow
     * @param string $workflowSid Returns the list of Tasks that are being
     *                            controlled by the Workflow with the specified SID
     *                            value
     */
    public function __construct(Version $version, string $workspaceSid, string $workflowSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['workspaceSid' => $workspaceSid, 'workflowSid' => $workflowSid];
    }
    /**
     * Constructs a WorkflowStatisticsContext
     */
    public function getContext() : WorkflowStatisticsContext
    {
        return new WorkflowStatisticsContext($this->version, $this->solution['workspaceSid'], $this->solution['workflowSid']);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Taskrouter.V1.WorkflowStatisticsList]';
    }
}
