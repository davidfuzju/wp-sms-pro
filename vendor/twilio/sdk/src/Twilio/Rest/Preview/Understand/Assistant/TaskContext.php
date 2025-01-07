<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\Task\FieldList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\Task\SampleList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\Task\TaskActionsList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\Task\TaskStatisticsList;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property FieldList $fields
 * @property SampleList $samples
 * @property TaskActionsList $taskActions
 * @property TaskStatisticsList $statistics
 * @method \Twilio\Rest\Preview\Understand\Assistant\Task\FieldContext fields(string $sid)
 * @method \Twilio\Rest\Preview\Understand\Assistant\Task\SampleContext samples(string $sid)
 * @method \Twilio\Rest\Preview\Understand\Assistant\Task\TaskActionsContext taskActions()
 * @method \Twilio\Rest\Preview\Understand\Assistant\Task\TaskStatisticsContext statistics()
 */
class TaskContext extends InstanceContext
{
    protected $_fields;
    protected $_samples;
    protected $_taskActions;
    protected $_statistics;
    /**
     * Initialize the TaskContext
     *
     * @param Version $version Version that contains the resource
     * @param string $assistantSid The unique ID of the Assistant.
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    public function __construct(Version $version, $assistantSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['assistantSid' => $assistantSid, 'sid' => $sid];
        $this->uri = '/Assistants/' . \rawurlencode($assistantSid) . '/Tasks/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the TaskInstance
     *
     * @return TaskInstance Fetched TaskInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : TaskInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new TaskInstance($this->version, $payload, $this->solution['assistantSid'], $this->solution['sid']);
    }
    /**
     * Update the TaskInstance
     *
     * @param array|Options $options Optional Arguments
     * @return TaskInstance Updated TaskInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : TaskInstance
    {
        $options = new Values($options);
        $data = Values::of(['FriendlyName' => $options['friendlyName'], 'UniqueName' => $options['uniqueName'], 'Actions' => Serialize::jsonObject($options['actions']), 'ActionsUrl' => $options['actionsUrl']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new TaskInstance($this->version, $payload, $this->solution['assistantSid'], $this->solution['sid']);
    }
    /**
     * Delete the TaskInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Access the fields
     */
    protected function getFields() : FieldList
    {
        if (!$this->_fields) {
            $this->_fields = new FieldList($this->version, $this->solution['assistantSid'], $this->solution['sid']);
        }
        return $this->_fields;
    }
    /**
     * Access the samples
     */
    protected function getSamples() : SampleList
    {
        if (!$this->_samples) {
            $this->_samples = new SampleList($this->version, $this->solution['assistantSid'], $this->solution['sid']);
        }
        return $this->_samples;
    }
    /**
     * Access the taskActions
     */
    protected function getTaskActions() : TaskActionsList
    {
        if (!$this->_taskActions) {
            $this->_taskActions = new TaskActionsList($this->version, $this->solution['assistantSid'], $this->solution['sid']);
        }
        return $this->_taskActions;
    }
    /**
     * Access the statistics
     */
    protected function getStatistics() : TaskStatisticsList
    {
        if (!$this->_statistics) {
            $this->_statistics = new TaskStatisticsList($this->version, $this->solution['assistantSid'], $this->solution['sid']);
        }
        return $this->_statistics;
    }
    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get(string $name) : ListResource
    {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->{$method}();
        }
        throw new TwilioException('Unknown subresource ' . $name);
    }
    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments) : InstanceContext
    {
        $property = $this->{$name};
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }
        throw new TwilioException('Resource does not have a context');
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
        return '[Twilio.Preview.Understand.TaskContext ' . \implode(' ', $context) . ']';
    }
}
