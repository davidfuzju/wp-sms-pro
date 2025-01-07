<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Taskrouter\V1\Workspace\Workflow;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class WorkflowRealTimeStatisticsOptions
{
    /**
     * @param string $taskChannel Only calculate real-time statistics on this
     *                            TaskChannel
     * @return FetchWorkflowRealTimeStatisticsOptions Options builder
     */
    public static function fetch(string $taskChannel = Values::NONE) : FetchWorkflowRealTimeStatisticsOptions
    {
        return new FetchWorkflowRealTimeStatisticsOptions($taskChannel);
    }
}
class FetchWorkflowRealTimeStatisticsOptions extends Options
{
    /**
     * @param string $taskChannel Only calculate real-time statistics on this
     *                            TaskChannel
     */
    public function __construct(string $taskChannel = Values::NONE)
    {
        $this->options['taskChannel'] = $taskChannel;
    }
    /**
     * Only calculate real-time statistics on this TaskChannel. Can be the TaskChannel's SID or its `unique_name`, such as `voice`, `sms`, or `default`.
     *
     * @param string $taskChannel Only calculate real-time statistics on this
     *                            TaskChannel
     * @return $this Fluent Builder
     */
    public function setTaskChannel(string $taskChannel) : self
    {
        $this->options['taskChannel'] = $taskChannel;
        return $this;
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Taskrouter.V1.FetchWorkflowRealTimeStatisticsOptions ' . $options . ']';
    }
}
