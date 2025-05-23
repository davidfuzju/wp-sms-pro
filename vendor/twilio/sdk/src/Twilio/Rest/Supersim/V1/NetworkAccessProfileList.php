<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Supersim\V1;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Serialize;
use WPSmsPro\Vendor\Twilio\Stream;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
class NetworkAccessProfileList extends ListResource
{
    /**
     * Construct the NetworkAccessProfileList
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(Version $version)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = [];
        $this->uri = '/NetworkAccessProfiles';
    }
    /**
     * Create the NetworkAccessProfileInstance
     *
     * @param array|Options $options Optional Arguments
     * @return NetworkAccessProfileInstance Created NetworkAccessProfileInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(array $options = []) : NetworkAccessProfileInstance
    {
        $options = new Values($options);
        $data = Values::of(['UniqueName' => $options['uniqueName'], 'Networks' => Serialize::map($options['networks'], function ($e) {
            return $e;
        })]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new NetworkAccessProfileInstance($this->version, $payload);
    }
    /**
     * Streams NetworkAccessProfileInstance records from the API as a generator
     * stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
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
    public function stream(int $limit = null, $pageSize = null) : Stream
    {
        $limits = $this->version->readLimits($limit, $pageSize);
        $page = $this->page($limits['pageSize']);
        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }
    /**
     * Reads NetworkAccessProfileInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return NetworkAccessProfileInstance[] Array of results
     */
    public function read(int $limit = null, $pageSize = null) : array
    {
        return \iterator_to_array($this->stream($limit, $pageSize), \false);
    }
    /**
     * Retrieve a single page of NetworkAccessProfileInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return NetworkAccessProfilePage Page of NetworkAccessProfileInstance
     */
    public function page($pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE) : NetworkAccessProfilePage
    {
        $params = Values::of(['PageToken' => $pageToken, 'Page' => $pageNumber, 'PageSize' => $pageSize]);
        $response = $this->version->page('GET', $this->uri, $params);
        return new NetworkAccessProfilePage($this->version, $response, $this->solution);
    }
    /**
     * Retrieve a specific page of NetworkAccessProfileInstance records from the
     * API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return NetworkAccessProfilePage Page of NetworkAccessProfileInstance
     */
    public function getPage(string $targetUrl) : NetworkAccessProfilePage
    {
        $response = $this->version->getDomain()->getClient()->request('GET', $targetUrl);
        return new NetworkAccessProfilePage($this->version, $response, $this->solution);
    }
    /**
     * Constructs a NetworkAccessProfileContext
     *
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function getContext(string $sid) : NetworkAccessProfileContext
    {
        return new NetworkAccessProfileContext($this->version, $sid);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Supersim.V1.NetworkAccessProfileList]';
    }
}
