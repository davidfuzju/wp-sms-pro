<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Taskrouter\V1\Workspace;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class ActivityContext extends InstanceContext
{
    /**
     * Initialize the ActivityContext
     *
     * @param Version $version Version that contains the resource
     * @param string $workspaceSid The SID of the Workspace with the Activity
     *                             resources to fetch
     * @param string $sid The SID of the resource to fetch
     */
    public function __construct(Version $version, $workspaceSid, $sid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['workspaceSid' => $workspaceSid, 'sid' => $sid];
        $this->uri = '/Workspaces/' . \rawurlencode($workspaceSid) . '/Activities/' . \rawurlencode($sid) . '';
    }
    /**
     * Fetch the ActivityInstance
     *
     * @return ActivityInstance Fetched ActivityInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : ActivityInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new ActivityInstance($this->version, $payload, $this->solution['workspaceSid'], $this->solution['sid']);
    }
    /**
     * Update the ActivityInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ActivityInstance Updated ActivityInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : ActivityInstance
    {
        $options = new Values($options);
        $data = Values::of(['FriendlyName' => $options['friendlyName']]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new ActivityInstance($this->version, $payload, $this->solution['workspaceSid'], $this->solution['sid']);
    }
    /**
     * Delete the ActivityInstance
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
        return '[Twilio.Taskrouter.V1.ActivityContext ' . \implode(' ', $context) . ']';
    }
}
