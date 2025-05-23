<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Taskrouter\V1\Workspace;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class TaskQueueOptions
{
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $targetWorkers A string describing the Worker selection
     *                              criteria for any Tasks that enter the TaskQueue
     * @param string $reservationActivitySid The SID of the Activity to assign
     *                                       Workers when a task is reserved for
     *                                       them
     * @param string $assignmentActivitySid The SID of the Activity to assign
     *                                      Workers when a task is assigned for them
     * @param int $maxReservedWorkers The maximum number of Workers to create
     *                                reservations for the assignment of a task
     *                                while in the queue
     * @param string $taskOrder How Tasks will be assigned to Workers
     * @return UpdateTaskQueueOptions Options builder
     */
    public static function update(string $friendlyName = Values::NONE, string $targetWorkers = Values::NONE, string $reservationActivitySid = Values::NONE, string $assignmentActivitySid = Values::NONE, int $maxReservedWorkers = Values::NONE, string $taskOrder = Values::NONE) : UpdateTaskQueueOptions
    {
        return new UpdateTaskQueueOptions($friendlyName, $targetWorkers, $reservationActivitySid, $assignmentActivitySid, $maxReservedWorkers, $taskOrder);
    }
    /**
     * @param string $friendlyName The friendly_name of the TaskQueue resources to
     *                             read
     * @param string $evaluateWorkerAttributes The attributes of the Workers to read
     * @param string $workerSid The SID of the Worker with the TaskQueue resources
     *                          to read
     * @return ReadTaskQueueOptions Options builder
     */
    public static function read(string $friendlyName = Values::NONE, string $evaluateWorkerAttributes = Values::NONE, string $workerSid = Values::NONE) : ReadTaskQueueOptions
    {
        return new ReadTaskQueueOptions($friendlyName, $evaluateWorkerAttributes, $workerSid);
    }
    /**
     * @param string $targetWorkers A string describing the Worker selection
     *                              criteria for any Tasks that enter the TaskQueue
     * @param int $maxReservedWorkers The maximum number of Workers to reserve
     * @param string $taskOrder How Tasks will be assigned to Workers
     * @param string $reservationActivitySid The SID of the Activity to assign
     *                                       Workers when a task is reserved for
     *                                       them
     * @param string $assignmentActivitySid The SID of the Activity to assign
     *                                      Workers once a task is assigned to them
     * @return CreateTaskQueueOptions Options builder
     */
    public static function create(string $targetWorkers = Values::NONE, int $maxReservedWorkers = Values::NONE, string $taskOrder = Values::NONE, string $reservationActivitySid = Values::NONE, string $assignmentActivitySid = Values::NONE) : CreateTaskQueueOptions
    {
        return new CreateTaskQueueOptions($targetWorkers, $maxReservedWorkers, $taskOrder, $reservationActivitySid, $assignmentActivitySid);
    }
}
class UpdateTaskQueueOptions extends Options
{
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $targetWorkers A string describing the Worker selection
     *                              criteria for any Tasks that enter the TaskQueue
     * @param string $reservationActivitySid The SID of the Activity to assign
     *                                       Workers when a task is reserved for
     *                                       them
     * @param string $assignmentActivitySid The SID of the Activity to assign
     *                                      Workers when a task is assigned for them
     * @param int $maxReservedWorkers The maximum number of Workers to create
     *                                reservations for the assignment of a task
     *                                while in the queue
     * @param string $taskOrder How Tasks will be assigned to Workers
     */
    public function __construct(string $friendlyName = Values::NONE, string $targetWorkers = Values::NONE, string $reservationActivitySid = Values::NONE, string $assignmentActivitySid = Values::NONE, int $maxReservedWorkers = Values::NONE, string $taskOrder = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['targetWorkers'] = $targetWorkers;
        $this->options['reservationActivitySid'] = $reservationActivitySid;
        $this->options['assignmentActivitySid'] = $assignmentActivitySid;
        $this->options['maxReservedWorkers'] = $maxReservedWorkers;
        $this->options['taskOrder'] = $taskOrder;
    }
    /**
     * A descriptive string that you create to describe the TaskQueue. For example `Support-Tier 1`, `Sales`, or `Escalation`.
     *
     * @param string $friendlyName A string to describe the resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * A string describing the Worker selection criteria for any Tasks that enter the TaskQueue. For example '"language" == "spanish"' If no TargetWorkers parameter is provided, Tasks will wait in the queue until they are either deleted or moved to another queue. Additional examples on how to describing Worker selection criteria below.
     *
     * @param string $targetWorkers A string describing the Worker selection
     *                              criteria for any Tasks that enter the TaskQueue
     * @return $this Fluent Builder
     */
    public function setTargetWorkers(string $targetWorkers) : self
    {
        $this->options['targetWorkers'] = $targetWorkers;
        return $this;
    }
    /**
     * The SID of the Activity to assign Workers when a task is reserved for them.
     *
     * @param string $reservationActivitySid The SID of the Activity to assign
     *                                       Workers when a task is reserved for
     *                                       them
     * @return $this Fluent Builder
     */
    public function setReservationActivitySid(string $reservationActivitySid) : self
    {
        $this->options['reservationActivitySid'] = $reservationActivitySid;
        return $this;
    }
    /**
     * The SID of the Activity to assign Workers when a task is assigned for them.
     *
     * @param string $assignmentActivitySid The SID of the Activity to assign
     *                                      Workers when a task is assigned for them
     * @return $this Fluent Builder
     */
    public function setAssignmentActivitySid(string $assignmentActivitySid) : self
    {
        $this->options['assignmentActivitySid'] = $assignmentActivitySid;
        return $this;
    }
    /**
     * The maximum number of Workers to create reservations for the assignment of a task while in the queue. Maximum of 50.
     *
     * @param int $maxReservedWorkers The maximum number of Workers to create
     *                                reservations for the assignment of a task
     *                                while in the queue
     * @return $this Fluent Builder
     */
    public function setMaxReservedWorkers(int $maxReservedWorkers) : self
    {
        $this->options['maxReservedWorkers'] = $maxReservedWorkers;
        return $this;
    }
    /**
     * How Tasks will be assigned to Workers. Can be: `FIFO` or `LIFO` and the default is `FIFO`. Use `FIFO` to assign the oldest task first and `LIFO` to assign the most recent task first. For more information, see [Queue Ordering](https://www.twilio.com/docs/taskrouter/queue-ordering-last-first-out-lifo).
     *
     * @param string $taskOrder How Tasks will be assigned to Workers
     * @return $this Fluent Builder
     */
    public function setTaskOrder(string $taskOrder) : self
    {
        $this->options['taskOrder'] = $taskOrder;
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
        return '[Twilio.Taskrouter.V1.UpdateTaskQueueOptions ' . $options . ']';
    }
}
class ReadTaskQueueOptions extends Options
{
    /**
     * @param string $friendlyName The friendly_name of the TaskQueue resources to
     *                             read
     * @param string $evaluateWorkerAttributes The attributes of the Workers to read
     * @param string $workerSid The SID of the Worker with the TaskQueue resources
     *                          to read
     */
    public function __construct(string $friendlyName = Values::NONE, string $evaluateWorkerAttributes = Values::NONE, string $workerSid = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['evaluateWorkerAttributes'] = $evaluateWorkerAttributes;
        $this->options['workerSid'] = $workerSid;
    }
    /**
     * The `friendly_name` of the TaskQueue resources to read.
     *
     * @param string $friendlyName The friendly_name of the TaskQueue resources to
     *                             read
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * The attributes of the Workers to read. Returns the TaskQueues with Workers that match the attributes specified in this parameter.
     *
     * @param string $evaluateWorkerAttributes The attributes of the Workers to read
     * @return $this Fluent Builder
     */
    public function setEvaluateWorkerAttributes(string $evaluateWorkerAttributes) : self
    {
        $this->options['evaluateWorkerAttributes'] = $evaluateWorkerAttributes;
        return $this;
    }
    /**
     * The SID of the Worker with the TaskQueue resources to read.
     *
     * @param string $workerSid The SID of the Worker with the TaskQueue resources
     *                          to read
     * @return $this Fluent Builder
     */
    public function setWorkerSid(string $workerSid) : self
    {
        $this->options['workerSid'] = $workerSid;
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
        return '[Twilio.Taskrouter.V1.ReadTaskQueueOptions ' . $options . ']';
    }
}
class CreateTaskQueueOptions extends Options
{
    /**
     * @param string $targetWorkers A string describing the Worker selection
     *                              criteria for any Tasks that enter the TaskQueue
     * @param int $maxReservedWorkers The maximum number of Workers to reserve
     * @param string $taskOrder How Tasks will be assigned to Workers
     * @param string $reservationActivitySid The SID of the Activity to assign
     *                                       Workers when a task is reserved for
     *                                       them
     * @param string $assignmentActivitySid The SID of the Activity to assign
     *                                      Workers once a task is assigned to them
     */
    public function __construct(string $targetWorkers = Values::NONE, int $maxReservedWorkers = Values::NONE, string $taskOrder = Values::NONE, string $reservationActivitySid = Values::NONE, string $assignmentActivitySid = Values::NONE)
    {
        $this->options['targetWorkers'] = $targetWorkers;
        $this->options['maxReservedWorkers'] = $maxReservedWorkers;
        $this->options['taskOrder'] = $taskOrder;
        $this->options['reservationActivitySid'] = $reservationActivitySid;
        $this->options['assignmentActivitySid'] = $assignmentActivitySid;
    }
    /**
     * A string that describes the Worker selection criteria for any Tasks that enter the TaskQueue. For example, `'"language" == "spanish"'`. The default value is `1==1`. If this value is empty, Tasks will wait in the TaskQueue until they are deleted or moved to another TaskQueue. For more information about Worker selection, see [Describing Worker selection criteria](https://www.twilio.com/docs/taskrouter/api/taskqueues#target-workers).
     *
     * @param string $targetWorkers A string describing the Worker selection
     *                              criteria for any Tasks that enter the TaskQueue
     * @return $this Fluent Builder
     */
    public function setTargetWorkers(string $targetWorkers) : self
    {
        $this->options['targetWorkers'] = $targetWorkers;
        return $this;
    }
    /**
     * The maximum number of Workers to reserve for the assignment of a Task in the queue. Can be an integer between 1 and 50, inclusive and defaults to 1.
     *
     * @param int $maxReservedWorkers The maximum number of Workers to reserve
     * @return $this Fluent Builder
     */
    public function setMaxReservedWorkers(int $maxReservedWorkers) : self
    {
        $this->options['maxReservedWorkers'] = $maxReservedWorkers;
        return $this;
    }
    /**
     * How Tasks will be assigned to Workers. Set this parameter to `LIFO` to assign most recently created Task first or FIFO to assign the oldest Task first. Default is `FIFO`. [Click here](https://www.twilio.com/docs/taskrouter/queue-ordering-last-first-out-lifo) to learn more.
     *
     * @param string $taskOrder How Tasks will be assigned to Workers
     * @return $this Fluent Builder
     */
    public function setTaskOrder(string $taskOrder) : self
    {
        $this->options['taskOrder'] = $taskOrder;
        return $this;
    }
    /**
     * The SID of the Activity to assign Workers when a task is reserved for them.
     *
     * @param string $reservationActivitySid The SID of the Activity to assign
     *                                       Workers when a task is reserved for
     *                                       them
     * @return $this Fluent Builder
     */
    public function setReservationActivitySid(string $reservationActivitySid) : self
    {
        $this->options['reservationActivitySid'] = $reservationActivitySid;
        return $this;
    }
    /**
     * The SID of the Activity to assign Workers when a task is assigned to them.
     *
     * @param string $assignmentActivitySid The SID of the Activity to assign
     *                                      Workers once a task is assigned to them
     * @return $this Fluent Builder
     */
    public function setAssignmentActivitySid(string $assignmentActivitySid) : self
    {
        $this->options['assignmentActivitySid'] = $assignmentActivitySid;
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
        return '[Twilio.Taskrouter.V1.CreateTaskQueueOptions ' . $options . ']';
    }
}
