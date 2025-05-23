<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Taskrouter\V1\Workspace\Workflow;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class WorkflowRealTimeStatisticsContext extends InstanceContext
{
    /**
     * Initialize the WorkflowRealTimeStatisticsContext
     *
     * @param Version $version Version that contains the resource
     * @param string $workspaceSid The SID of the Workspace with the Workflow to
     *                             fetch
     * @param string $workflowSid Returns the list of Tasks that are being
     *                            controlled by the Workflow with the specified SID
     *                            value
     */
    public function __construct(Version $version, $workspaceSid, $workflowSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['workspaceSid' => $workspaceSid, 'workflowSid' => $workflowSid];
        $this->uri = '/Workspaces/' . \rawurlencode($workspaceSid) . '/Workflows/' . \rawurlencode($workflowSid) . '/RealTimeStatistics';
    }
    /**
     * Fetch the WorkflowRealTimeStatisticsInstance
     *
     * @param array|Options $options Optional Arguments
     * @return WorkflowRealTimeStatisticsInstance Fetched
     *                                            WorkflowRealTimeStatisticsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(array $options = []) : WorkflowRealTimeStatisticsInstance
    {
        $options = new Values($options);
        $params = Values::of(['TaskChannel' => $options['taskChannel']]);
        $payload = $this->version->fetch('GET', $this->uri, $params);
        return new WorkflowRealTimeStatisticsInstance($this->version, $payload, $this->solution['workspaceSid'], $this->solution['workflowSid']);
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
        return '[Twilio.Taskrouter.V1.WorkflowRealTimeStatisticsContext ' . \implode(' ', $context) . ']';
    }
}
