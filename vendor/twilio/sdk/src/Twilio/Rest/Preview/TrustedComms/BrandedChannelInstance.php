<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\TrustedComms;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Rest\Preview\TrustedComms\BrandedChannel\ChannelList;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $accountSid
 * @property string $businessSid
 * @property string $brandSid
 * @property string $sid
 * @property array $links
 * @property string $url
 */
class BrandedChannelInstance extends InstanceResource
{
    protected $_channels;
    /**
     * Initialize the BrandedChannelInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid Branded Channel Sid.
     */
    public function __construct(Version $version, array $payload, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'businessSid' => Values::array_get($payload, 'business_sid'), 'brandSid' => Values::array_get($payload, 'brand_sid'), 'sid' => Values::array_get($payload, 'sid'), 'links' => Values::array_get($payload, 'links'), 'url' => Values::array_get($payload, 'url')];
        $this->solution = ['sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return BrandedChannelContext Context for this BrandedChannelInstance
     */
    protected function proxy() : BrandedChannelContext
    {
        if (!$this->context) {
            $this->context = new BrandedChannelContext($this->version, $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the BrandedChannelInstance
     *
     * @return BrandedChannelInstance Fetched BrandedChannelInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : BrandedChannelInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Access the channels
     */
    protected function getChannels() : ChannelList
    {
        return $this->proxy()->channels;
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
        return '[Twilio.Preview.TrustedComms.BrandedChannelInstance ' . \implode(' ', $context) . ']';
    }
}
