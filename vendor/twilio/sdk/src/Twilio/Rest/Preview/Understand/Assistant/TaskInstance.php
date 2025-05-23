<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\Task\FieldList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\Task\SampleList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\Task\TaskActionsList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\Task\TaskStatisticsList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $accountSid
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $friendlyName
 * @property array $links
 * @property string $assistantSid
 * @property string $sid
 * @property string $uniqueName
 * @property string $actionsUrl
 * @property string $url
 */
class TaskInstance extends InstanceResource
{
    protected $_fields;
    protected $_samples;
    protected $_taskActions;
    protected $_statistics;
    /**
     * Initialize the TaskInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $assistantSid The unique ID of the Assistant.
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    public function __construct(Version $version, array $payload, string $assistantSid, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')), 'friendlyName' => Values::array_get($payload, 'friendly_name'), 'links' => Values::array_get($payload, 'links'), 'assistantSid' => Values::array_get($payload, 'assistant_sid'), 'sid' => Values::array_get($payload, 'sid'), 'uniqueName' => Values::array_get($payload, 'unique_name'), 'actionsUrl' => Values::array_get($payload, 'actions_url'), 'url' => Values::array_get($payload, 'url')];
        $this->solution = ['assistantSid' => $assistantSid, 'sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return TaskContext Context for this TaskInstance
     */
    protected function proxy() : TaskContext
    {
        if (!$this->context) {
            $this->context = new TaskContext($this->version, $this->solution['assistantSid'], $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the TaskInstance
     *
     * @return TaskInstance Fetched TaskInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : TaskInstance
    {
        return $this->proxy()->fetch();
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
        return $this->proxy()->update($options);
    }
    /**
     * Delete the TaskInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->proxy()->delete();
    }
    /**
     * Access the fields
     */
    protected function getFields() : FieldList
    {
        return $this->proxy()->fields;
    }
    /**
     * Access the samples
     */
    protected function getSamples() : SampleList
    {
        return $this->proxy()->samples;
    }
    /**
     * Access the taskActions
     */
    protected function getTaskActions() : TaskActionsList
    {
        return $this->proxy()->taskActions;
    }
    /**
     * Access the statistics
     */
    protected function getStatistics() : TaskStatisticsList
    {
        return $this->proxy()->statistics;
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
        return '[Twilio.Preview.Understand.TaskInstance ' . \implode(' ', $context) . ']';
    }
}
