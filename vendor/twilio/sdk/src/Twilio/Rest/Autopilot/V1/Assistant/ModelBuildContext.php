<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Autopilot\V1\Assistant;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class ModelBuildContext extends InstanceContext
{
    /**
     * Initialize the ModelBuildContext
     *
     * @param Version $version Version that contains the resource
     * @param string $assistantSid The SID of the Assistant that is the parent of
     *                             the resource to fetch
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $assistantSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['assistantSid' => $assistantSid, 'sid' => $sid];
        $this->uri = '/Assistants/' . \rawurlencode($assistantSid) . '/ModelBuilds/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the ModelBuildInstance
     *
     * @return ModelBuildInstance Fetched ModelBuildInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : ModelBuildInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new ModelBuildInstance($this->version, $payload, $this->solution['assistantSid'], $this->solution['sid']);
    }
    /**
     * Update the ModelBuildInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ModelBuildInstance Updated ModelBuildInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : ModelBuildInstance
    {
        $options = new Values($options);
        $data = Values::of(['UniqueName' => $options['uniqueName']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new ModelBuildInstance($this->version, $payload, $this->solution['assistantSid'], $this->solution['sid']);
    }
    /**
     * Delete the ModelBuildInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
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
        return '[Twilio.Autopilot.V1.ModelBuildContext ' . \implode(' ', $context) . ']';
    }
}
