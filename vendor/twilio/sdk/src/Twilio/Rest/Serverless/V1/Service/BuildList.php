<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Serverless\V1\Service;

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
class BuildList extends ListResource
{
    /**
     * Construct the BuildList
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid The SID of the Service that the Build resource is
     *                           associated with
     */
    public function __construct(Version $version, string $serviceSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid];
        $this->uri = '/Services/' . \rawurlencode($serviceSid) . '/Builds';
    }
    /**
     * Streams BuildInstance records from the API as a generator stream.
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
     * Reads BuildInstance records from the API as a list.
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
     * @return BuildInstance[] Array of results
     */
    public function read(int $limit = null, $pageSize = null) : array
    {
        return \iterator_to_array($this->stream($limit, $pageSize), \false);
    }
    /**
     * Retrieve a single page of BuildInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return BuildPage Page of BuildInstance
     */
    public function page($pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE) : BuildPage
    {
        $params = Values::of(['PageToken' => $pageToken, 'Page' => $pageNumber, 'PageSize' => $pageSize]);
        $response = $this->version->page('GET', $this->uri, $params);
        return new BuildPage($this->version, $response, $this->solution);
    }
    /**
     * Retrieve a specific page of BuildInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return BuildPage Page of BuildInstance
     */
    public function getPage(string $targetUrl) : BuildPage
    {
        $response = $this->version->getDomain()->getClient()->request('GET', $targetUrl);
        return new BuildPage($this->version, $response, $this->solution);
    }
    /**
     * Create the BuildInstance
     *
     * @param array|Options $options Optional Arguments
     * @return BuildInstance Created BuildInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(array $options = []) : BuildInstance
    {
        $options = new Values($options);
        $data = Values::of(['AssetVersions' => Serialize::map($options['assetVersions'], function ($e) {
            return $e;
        }), 'FunctionVersions' => Serialize::map($options['functionVersions'], function ($e) {
            return $e;
        }), 'Dependencies' => $options['dependencies'], 'Runtime' => $options['runtime']]);
        $payload = $this->version->create('POST', $this->uri, [], $data);
        return new BuildInstance($this->version, $payload, $this->solution['serviceSid']);
    }
    /**
     * Constructs a BuildContext
     *
     * @param string $sid The SID of the Build resource to fetch
     */
    public function getContext(string $sid) : BuildContext
    {
        return new BuildContext($this->version, $this->solution['serviceSid'], $sid);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Serverless.V1.BuildList]';
    }
}
