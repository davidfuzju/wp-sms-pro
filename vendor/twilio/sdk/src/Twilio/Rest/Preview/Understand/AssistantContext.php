<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Understand;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\AssistantFallbackActionsList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\AssistantInitiationActionsList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\DialogueList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\FieldTypeList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\ModelBuildList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\QueryList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\StyleSheetList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\TaskList;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property FieldTypeList $fieldTypes
 * @property TaskList $tasks
 * @property ModelBuildList $modelBuilds
 * @property QueryList $queries
 * @property AssistantFallbackActionsList $assistantFallbackActions
 * @property AssistantInitiationActionsList $assistantInitiationActions
 * @property DialogueList $dialogues
 * @property StyleSheetList $styleSheet
 * @method \Twilio\Rest\Preview\Understand\Assistant\FieldTypeContext fieldTypes(string $sid)
 * @method \Twilio\Rest\Preview\Understand\Assistant\TaskContext tasks(string $sid)
 * @method \Twilio\Rest\Preview\Understand\Assistant\ModelBuildContext modelBuilds(string $sid)
 * @method \Twilio\Rest\Preview\Understand\Assistant\QueryContext queries(string $sid)
 * @method \Twilio\Rest\Preview\Understand\Assistant\AssistantFallbackActionsContext assistantFallbackActions()
 * @method \Twilio\Rest\Preview\Understand\Assistant\AssistantInitiationActionsContext assistantInitiationActions()
 * @method \Twilio\Rest\Preview\Understand\Assistant\DialogueContext dialogues(string $sid)
 * @method \Twilio\Rest\Preview\Understand\Assistant\StyleSheetContext styleSheet()
 */
class AssistantContext extends InstanceContext
{
    protected $_fieldTypes;
    protected $_tasks;
    protected $_modelBuilds;
    protected $_queries;
    protected $_assistantFallbackActions;
    protected $_assistantInitiationActions;
    protected $_dialogues;
    protected $_styleSheet;
    /**
     * Initialize the AssistantContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    public function __construct(Version $version, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['sid' => $sid];
        $this->uri = '/Assistants/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the AssistantInstance
     *
     * @return AssistantInstance Fetched AssistantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : AssistantInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new AssistantInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Update the AssistantInstance
     *
     * @param array|Options $options Optional Arguments
     * @return AssistantInstance Updated AssistantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : AssistantInstance
    {
        $options = new Values($options);
        $data = Values::of(['FriendlyName' => $options['friendlyName'], 'LogQueries' => Serialize::booleanToString($options['logQueries']), 'UniqueName' => $options['uniqueName'], 'CallbackUrl' => $options['callbackUrl'], 'CallbackEvents' => $options['callbackEvents'], 'FallbackActions' => Serialize::jsonObject($options['fallbackActions']), 'InitiationActions' => Serialize::jsonObject($options['initiationActions']), 'StyleSheet' => Serialize::jsonObject($options['styleSheet'])]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new AssistantInstance($this->version, $payload, $this->solution['sid']);
    }
    /**
     * Delete the AssistantInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Access the fieldTypes
     */
    protected function getFieldTypes() : FieldTypeList
    {
        if (!$this->_fieldTypes) {
            $this->_fieldTypes = new FieldTypeList($this->version, $this->solution['sid']);
        }
        return $this->_fieldTypes;
    }
    /**
     * Access the tasks
     */
    protected function getTasks() : TaskList
    {
        if (!$this->_tasks) {
            $this->_tasks = new TaskList($this->version, $this->solution['sid']);
        }
        return $this->_tasks;
    }
    /**
     * Access the modelBuilds
     */
    protected function getModelBuilds() : ModelBuildList
    {
        if (!$this->_modelBuilds) {
            $this->_modelBuilds = new ModelBuildList($this->version, $this->solution['sid']);
        }
        return $this->_modelBuilds;
    }
    /**
     * Access the queries
     */
    protected function getQueries() : QueryList
    {
        if (!$this->_queries) {
            $this->_queries = new QueryList($this->version, $this->solution['sid']);
        }
        return $this->_queries;
    }
    /**
     * Access the assistantFallbackActions
     */
    protected function getAssistantFallbackActions() : AssistantFallbackActionsList
    {
        if (!$this->_assistantFallbackActions) {
            $this->_assistantFallbackActions = new AssistantFallbackActionsList($this->version, $this->solution['sid']);
        }
        return $this->_assistantFallbackActions;
    }
    /**
     * Access the assistantInitiationActions
     */
    protected function getAssistantInitiationActions() : AssistantInitiationActionsList
    {
        if (!$this->_assistantInitiationActions) {
            $this->_assistantInitiationActions = new AssistantInitiationActionsList($this->version, $this->solution['sid']);
        }
        return $this->_assistantInitiationActions;
    }
    /**
     * Access the dialogues
     */
    protected function getDialogues() : DialogueList
    {
        if (!$this->_dialogues) {
            $this->_dialogues = new DialogueList($this->version, $this->solution['sid']);
        }
        return $this->_dialogues;
    }
    /**
     * Access the styleSheet
     */
    protected function getStyleSheet() : StyleSheetList
    {
        if (!$this->_styleSheet) {
            $this->_styleSheet = new StyleSheetList($this->version, $this->solution['sid']);
        }
        return $this->_styleSheet;
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
        return '[Twilio.Preview.Understand.AssistantContext ' . \implode(' ', $context) . ']';
    }
}
