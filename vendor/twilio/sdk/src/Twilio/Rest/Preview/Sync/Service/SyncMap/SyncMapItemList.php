<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Sync\Service\SyncMap;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Stream;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class SyncMapItemList extends ListResource
{
    /**
     * Construct the SyncMapItemList
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid The service_sid
     * @param string $mapSid The map_sid
     */
    public function __construct(Version $version, string $serviceSid, string $mapSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid, 'mapSid' => $mapSid];
        $this->uri = '/Services/' . \rawurlencode($serviceSid) . '/Maps/' . \rawurlencode($mapSid) . '/Items';
    }
    /**
     * Create the SyncMapItemInstance
     *
     * @param string $key The key
     * @param array $data The data
     * @return SyncMapItemInstance Created SyncMapItemInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $key, array $data) : SyncMapItemInstance
    {
        $data = Values::of(['Key' => $key, 'Data' => Serialize::jsonObject($data)]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new SyncMapItemInstance($this->version, $payload, $this->solution['serviceSid'], $this->solution['mapSid']);
    }
    /**
     * Streams SyncMapItemInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, stream()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return Stream stream of results
     */
    public function stream(array $options = [], int $limit = null, $pageSize = null) : Stream
    {
        $limits = $this->version->readLimits($limit, $pageSize);
        $page = $this->page($options, $limits['pageSize']);
        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }
    /**
     * Reads SyncMapItemInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return SyncMapItemInstance[] Array of results
     */
    public function read(array $options = [], int $limit = null, $pageSize = null) : array
    {
        return \iterator_to_array($this->stream($options, $limit, $pageSize), \false);
    }
    /**
     * Retrieve a single page of SyncMapItemInstance records from the API.
     * Request is executed immediately
     *
     * @param array|Options $options Optional Arguments
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return SyncMapItemPage Page of SyncMapItemInstance
     */
    public function page(array $options = [], $pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE) : SyncMapItemPage
    {
        $options = new Values($options);
        $params = Values::of(['Order' => $options['order'], 'From' => $options['from'], 'Bounds' => $options['bounds'], 'PageToken' => $pageToken, 'Page' => $pageNumber, 'PageSize' => $pageSize]);
        $response = $this->version->page('GET', $this->uri, $params);
        return new SyncMapItemPage($this->version, $response, $this->solution);
    }
    /**
     * Retrieve a specific page of SyncMapItemInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return SyncMapItemPage Page of SyncMapItemInstance
     */
    public function getPage(string $targetUrl) : SyncMapItemPage
    {
        $response = $this->version->getDomain()->getClient()->request('GET', $targetUrl);
        return new SyncMapItemPage($this->version, $response, $this->solution);
    }
    /**
     * Constructs a SyncMapItemContext
     *
     * @param string $key The key
     */
    public function getContext(string $key) : SyncMapItemContext
    {
        return new SyncMapItemContext($this->version, $this->solution['serviceSid'], $this->solution['mapSid'], $key);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Preview.Sync.SyncMapItemList]';
    }
}
