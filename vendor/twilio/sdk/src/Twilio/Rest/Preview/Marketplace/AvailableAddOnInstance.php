<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Marketplace;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Rest\Preview\Marketplace\AvailableAddOn\AvailableAddOnExtensionList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $sid
 * @property string $friendlyName
 * @property string $description
 * @property string $pricingType
 * @property array $configurationSchema
 * @property string $url
 * @property array $links
 */
class AvailableAddOnInstance extends InstanceResource
{
    protected $_extensions;
    /**
     * Initialize the AvailableAddOnInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The SID of the AvailableAddOn resource to fetch
     */
    public function __construct(Version $version, array $payload, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['sid' => Values::array_get($payload, 'sid'), 'friendlyName' => Values::array_get($payload, 'friendly_name'), 'description' => Values::array_get($payload, 'description'), 'pricingType' => Values::array_get($payload, 'pricing_type'), 'configurationSchema' => Values::array_get($payload, 'configuration_schema'), 'url' => Values::array_get($payload, 'url'), 'links' => Values::array_get($payload, 'links')];
        $this->solution = ['sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return AvailableAddOnContext Context for this AvailableAddOnInstance
     */
    protected function proxy() : AvailableAddOnContext
    {
        if (!$this->context) {
            $this->context = new AvailableAddOnContext($this->version, $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the AvailableAddOnInstance
     *
     * @return AvailableAddOnInstance Fetched AvailableAddOnInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : AvailableAddOnInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Access the extensions
     */
    protected function getExtensions() : AvailableAddOnExtensionList
    {
        return $this->proxy()->extensions;
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
        return '[Twilio.Preview.Marketplace.AvailableAddOnInstance ' . \implode(' ', $context) . ']';
    }
}
