<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Sync\Service\SyncList;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class SyncListPermissionContext extends InstanceContext
{
    /**
     * Initialize the SyncListPermissionContext
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid The service_sid
     * @param string $listSid Sync List SID or unique name.
     * @param string $identity Identity of the user to whom the Sync List
     *                         Permission applies.
     */
    public function __construct(Version $version, $serviceSid, $listSid, $identity)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid, 'listSid' => $listSid, 'identity' => $identity];
        $this->uri = '/Services/' . \rawurlencode($serviceSid) . '/Lists/' . \rawurlencode($listSid) . '/Permissions/' . \rawurlencode($identity) . '';
    }
    /**
     * Fetch the SyncListPermissionInstance
     *
     * @return SyncListPermissionInstance Fetched SyncListPermissionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : SyncListPermissionInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new SyncListPermissionInstance($this->version, $payload, $this->solution['serviceSid'], $this->solution['listSid'], $this->solution['identity']);
    }
    /**
     * Delete the SyncListPermissionInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->version->delete('DELETE', $this->uri);
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
        $data = Values::of(['Read' => Serialize::booleanToString($read), 'Write' => Serialize::booleanToString($write), 'Manage' => Serialize::booleanToString($manage)]);
        $payload = $this->version->update('POST', $this->uri, [], $data);
        return new SyncListPermissionInstance($this->version, $payload, $this->solution['serviceSid'], $this->solution['listSid'], $this->solution['identity']);
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
        return '[Twilio.Preview.Sync.SyncListPermissionContext ' . \implode(' ', $context) . ']';
    }
}
