<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Sync\Service\SyncList;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $accountSid
 * @property string $serviceSid
 * @property string $listSid
 * @property string $identity
 * @property bool $read
 * @property bool $write
 * @property bool $manage
 * @property string $url
 */
class SyncListPermissionInstance extends InstanceResource
{
    /**
     * Initialize the SyncListPermissionInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid Sync Service Instance SID.
     * @param string $listSid Sync List SID.
     * @param string $identity Identity of the user to whom the Sync List
     *                         Permission applies.
     */
    public function __construct(Version $version, array $payload, string $serviceSid, string $listSid, string $identity = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'serviceSid' => Values::array_get($payload, 'service_sid'), 'listSid' => Values::array_get($payload, 'list_sid'), 'identity' => Values::array_get($payload, 'identity'), 'read' => Values::array_get($payload, 'read'), 'write' => Values::array_get($payload, 'write'), 'manage' => Values::array_get($payload, 'manage'), 'url' => Values::array_get($payload, 'url')];
        $this->solution = ['serviceSid' => $serviceSid, 'listSid' => $listSid, 'identity' => $identity ?: $this->properties['identity']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return SyncListPermissionContext Context for this SyncListPermissionInstance
     */
    protected function proxy() : SyncListPermissionContext
    {
        if (!$this->context) {
            $this->context = new SyncListPermissionContext($this->version, $this->solution['serviceSid'], $this->solution['listSid'], $this->solution['identity']);
        }
        return $this->context;
    }
    /**
     * Fetch the SyncListPermissionInstance
     *
     * @return SyncListPermissionInstance Fetched SyncListPermissionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : SyncListPermissionInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Delete the SyncListPermissionInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->proxy()->delete();
    }
    /**
     * Update the SyncListPermissionInstance
     *
     * @param bool $read Read access.
     * @param bool $write Write access.
     * @param bool $manage Manage access.
     * @return SyncListPermissionInstance Updated SyncListPermissionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(bool $read, bool $write, bool $manage) : SyncListPermissionInstance
    {
        return $this->proxy()->update($read, $write, $manage);
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
        return '[Twilio.Preview.Sync.SyncListPermissionInstance ' . \implode(' ', $context) . ']';
    }
}
