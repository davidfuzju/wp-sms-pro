<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Sync\V1\Service\SyncList;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
class SyncListItemContext extends InstanceContext
{
    /**
     * Initialize the SyncListItemContext
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid The SID of the Sync Service with the Sync List
     *                           Item resource to fetch
     * @param string $listSid The SID of the Sync List with the Sync List Item
     *                        resource to fetch
     * @param int $index The index of the Sync List Item resource to fetch
     */
    public function __construct(Version $version, $serviceSid, $listSid, $index)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid, 'listSid' => $listSid, 'index' => $index];
        $this->uri = '/Services/' . \rawurlencode($serviceSid) . '/Lists/' . \rawurlencode($listSid) . '/Items/' . \rawurlencode($index) . '';
    }
    /**
     * Fetch the SyncListItemInstance
     *
     * @return SyncListItemInstance Fetched SyncListItemInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : SyncListItemInstance
    {
        $payload = $this->version->fetch('GET', $this->uri);
        return new SyncListItemInstance($this->version, $payload, $this->solution['serviceSid'], $this->solution['listSid'], $this->solution['index']);
    }
    /**
     * Delete the SyncListItemInstance
     *
     * @param array|Options $options Optional Arguments
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(array $options = []) : bool
    {
        $options = new Values($options);
        $headers = Values::of(['If-Match' => $options['ifMatch']]);
        return $this->version->delete('DELETE', $this->uri, [], [], $headers);
    }
    /**
     * Update the SyncListItemInstance
     *
     * @param array|Options $options Optional Arguments
     * @return SyncListItemInstance Updated SyncListItemInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : SyncListItemInstance
    {
        $options = new Values($options);
        $data = Values::of(['Data' => Serialize::jsonObject($options['data']), 'Ttl' => $options['ttl'], 'ItemTtl' => $options['itemTtl'], 'CollectionTtl' => $options['collectionTtl']]);
        $headers = Values::of(['If-Match' => $options['ifMatch']]);
        $payload = $this->version->update('POST', $this->uri, [], $data, $headers);
        return new SyncListItemInstance($this->version, $payload, $this->solution['serviceSid'], $this->solution['listSid'], $this->solution['index']);
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
        return '[Twilio.Sync.V1.SyncListItemContext ' . \implode(' ', $context) . ']';
    }
}
