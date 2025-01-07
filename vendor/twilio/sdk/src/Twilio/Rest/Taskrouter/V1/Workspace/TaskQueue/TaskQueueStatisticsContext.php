<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Taskrouter\V1\Workspace\TaskQueue;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class TaskQueueStatisticsContext extends InstanceContext
{
    /**
     * Initialize the TaskQueueStatisticsContext
     *
     * @param Version $version Version that contains the resource
     * @param string $workspaceSid The SID of the Workspace with the TaskQueue to
     *                             fetch
     * @param string $taskQueueSid The SID of the TaskQueue for which to fetch
     *                             statistics
     */
    public function __construct(Version $version, $workspaceSid, $taskQueueSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['workspaceSid' => $workspaceSid, 'taskQueueSid' => $taskQueueSid];
        $this->uri = '/Workspaces/' . \rawurlencode($workspaceSid) . '/TaskQueues/' . \rawurlencode($taskQueueSid) . '/Statistics';
    }
    /**
     * Fetch the TaskQueueStatisticsInstance
     *
     * @param array|Options $options Optional Arguments
     * @return TaskQueueStatisticsInstance Fetched TaskQueueStatisticsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(array $options = []) : TaskQueueStatisticsInstance
    {
        $options = new Values($options);
        $params = Values::of(['EndDate' => Serialize::iso8601DateTime($options['endDate']), 'Minutes' => $options['minutes'], 'StartDate' => Serialize::iso8601DateTime($options['startDate']), 'TaskChannel' => $options['taskChannel'], 'SplitByWaitTime' => $options['splitByWaitTime']]);
        $payload = $this->version->fetch('GET', $this->uri, $params);
        return new TaskQueueStatisticsInstance($this->version, $payload, $this->solution['workspaceSid'], $this->solution['taskQueueSid']);
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
        return '[Twilio.Taskrouter.V1.TaskQueueStatisticsContext ' . \implode(' ', $context) . ']';
    }
}
