<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Voice\V1\DialingPermissions;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Rest\Voice\V1\DialingPermissions\Country\HighriskSpecialPrefixList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $isoCode
 * @property string $name
 * @property string $continent
 * @property string[] $countryCodes
 * @property bool $lowRiskNumbersEnabled
 * @property bool $highRiskSpecialNumbersEnabled
 * @property bool $highRiskTollfraudNumbersEnabled
 * @property string $url
 * @property array $links
 */
class CountryInstance extends InstanceResource
{
    protected $_highriskSpecialPrefixes;
    /**
     * Initialize the CountryInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $isoCode The ISO country code
     */
    public function __construct(Version $version, array $payload, string $isoCode = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['isoCode' => Values::array_get($payload, 'iso_code'), 'name' => Values::array_get($payload, 'name'), 'continent' => Values::array_get($payload, 'continent'), 'countryCodes' => Values::array_get($payload, 'country_codes'), 'lowRiskNumbersEnabled' => Values::array_get($payload, 'low_risk_numbers_enabled'), 'highRiskSpecialNumbersEnabled' => Values::array_get($payload, 'high_risk_special_numbers_enabled'), 'highRiskTollfraudNumbersEnabled' => Values::array_get($payload, 'high_risk_tollfraud_numbers_enabled'), 'url' => Values::array_get($payload, 'url'), 'links' => Values::array_get($payload, 'links')];
        $this->solution = ['isoCode' => $isoCode ?: $this->properties['isoCode']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return CountryContext Context for this CountryInstance
     */
    protected function proxy() : CountryContext
    {
        if (!$this->context) {
            $this->context = new CountryContext($this->version, $this->solution['isoCode']);
        }
        return $this->context;
    }
    /**
     * Fetch the CountryInstance
     *
     * @return CountryInstance Fetched CountryInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : CountryInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Access the highriskSpecialPrefixes
     */
    protected function getHighriskSpecialPrefixes() : HighriskSpecialPrefixList
    {
        return $this->proxy()->highriskSpecialPrefixes;
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
        return '[Twilio.Voice.V1.CountryInstance ' . \implode(' ', $context) . ']';
    }
}
