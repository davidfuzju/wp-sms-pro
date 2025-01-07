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
use WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant\FieldType\FieldValueList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property FieldValueList $fieldValues
 * @method \Twilio\Rest\Preview\Understand\Assistant\FieldType\FieldValueContext fieldValues(string $sid)
 */
class FieldTypeContext extends InstanceContext
{
    protected $_fieldValues;
    /**
     * Initialize the FieldTypeContext
     *
     * @param Version $version Version that contains the resource
     * @param string $assistantSid The assistant_sid
     * @param string $sid The sid
     */
    public function __construct(Version $version, $assistantSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['assistantSid' => $assistantSid, 'sid' => $sid];
        $this->uri = '/Assistants/' . \rawurlencode($assistantSid) . '/FieldTypes/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the FieldTypeInstance
     *
     * @return FieldTypeInstance Fetched FieldTypeInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : FieldTypeInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new FieldTypeInstance($this->version, $payload, $this->solution['assistantSid'], $this->solution['sid']);
    }
    /**
     * Update the FieldTypeInstance
     *
     * @param array|Options $options Optional Arguments
     * @return FieldTypeInstance Updated FieldTypeInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : FieldTypeInstance
    {
        $options = new Values($options);
        $data = Values::of(['FriendlyName' => $options['friendlyName'], 'UniqueName' => $options['uniqueName']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new FieldTypeInstance($this->version, $payload, $this->solution['assistantSid'], $this->solution['sid']);
    }
    /**
     * Delete the FieldTypeInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
    }
    /**
     * Access the fieldValues
     */
    protected function getFieldValues() : FieldValueList
    {
        if (!$this->_fieldValues) {
            $this->_fieldValues = new FieldValueList($this->version, $this->solution['assistantSid'], $this->solution['sid']);
        }
        return $this->_fieldValues;
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
        return '[Twilio.Preview.Understand.FieldTypeContext ' . \implode(' ', $context) . ']';
    }
}
