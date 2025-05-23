<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Taskrouter\V1\Workspace\Workflow;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $accountSid
 * @property int $longestTaskWaitingAge
 * @property string $longestTaskWaitingSid
 * @property array $tasksByPriority
 * @property array $tasksByStatus
 * @property int $totalTasks
 * @property string $workflowSid
 * @property string $workspaceSid
 * @property string $url
 */
class WorkflowRealTimeStatisticsInstance extends InstanceResource
{
    /**
     * Initialize the WorkflowRealTimeStatisticsInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $workspaceSid The SID of the Workspace that contains the
     *                             Workflow.
     * @param string $workflowSid Returns the list of Tasks that are being
     *                            controlled by the Workflow with the specified SID
     *                            value
     */
    public function __construct(Version $version, array $payload, string $workspaceSid, string $workflowSid)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'longestTaskWaitingAge' => Values::array_get($payload, 'longest_task_waiting_age'), 'longestTaskWaitingSid' => Values::array_get($payload, 'longest_task_waiting_sid'), 'tasksByPriority' => Values::array_get($payload, 'tasks_by_priority'), 'tasksByStatus' => Values::array_get($payload, 'tasks_by_status'), 'totalTasks' => Values::array_get($payload, 'total_tasks'), 'workflowSid' => Values::array_get($payload, 'workflow_sid'), 'workspaceSid' => Values::array_get($payload, 'workspace_sid'), 'url' => Values::array_get($payload, 'url')];
        $this->solution = ['workspaceSid' => $workspaceSid, 'workflowSid' => $workflowSid];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return WorkflowRealTimeStatisticsContext Context for this
     *                                           WorkflowRealTimeStatisticsInstance
     */
    protected function proxy() : WorkflowRealTimeStatisticsContext
    {
        if (!$this->context) {
            $this->context = new WorkflowRealTimeStatisticsContext($this->version, $this->solution['workspaceSid'], $this->solution['workflowSid']);
        }
        return $this->context;
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
        return $this->proxy()->fetch($options);
    }
    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->{$method}();
        }
        throw new TwilioException('Unknown property: ' . $name);
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
        return '[Twilio.Taskrouter.V1.WorkflowRealTimeStatisticsInstance ' . \implode(' ', $context) . ']';
    }
}
