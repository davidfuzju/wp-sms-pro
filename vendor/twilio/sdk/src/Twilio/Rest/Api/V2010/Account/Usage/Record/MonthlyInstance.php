<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account\Usage\Record;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $accountSid
 * @property string $apiVersion
 * @property string $asOf
 * @property string $category
 * @property string $count
 * @property string $countUnit
 * @property string $description
 * @property \DateTime $endDate
 * @property string $price
 * @property string $priceUnit
 * @property \DateTime $startDate
 * @property array $subresourceUris
 * @property string $uri
 * @property string $usage
 * @property string $usageUnit
 */
class MonthlyInstance extends InstanceResource
{
    /**
     * Initialize the MonthlyInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid A 34 character string that uniquely identifies
     *                           this resource.
     */
    public function __construct(Version $version, array $payload, string $accountSid)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'apiVersion' => Values::array_get($payload, 'api_version'), 'asOf' => Values::array_get($payload, 'as_of'), 'category' => Values::array_get($payload, 'category'), 'count' => Values::array_get($payload, 'count'), 'countUnit' => Values::array_get($payload, 'count_unit'), 'description' => Values::array_get($payload, 'description'), 'endDate' => Deserialize::dateTime(Values::array_get($payload, 'end_date')), 'price' => Values::array_get($payload, 'price'), 'priceUnit' => Values::array_get($payload, 'price_unit'), 'startDate' => Deserialize::dateTime(Values::array_get($payload, 'start_date')), 'subresourceUris' => Values::array_get($payload, 'subresource_uris'), 'uri' => Values::array_get($payload, 'uri'), 'usage' => Values::array_get($payload, 'usage'), 'usageUnit' => Values::array_get($payload, 'usage_unit')];
        $this->solution = ['accountSid' => $accountSid];
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
        return '[Twilio.Api.V2010.MonthlyInstance]';
    }
}
