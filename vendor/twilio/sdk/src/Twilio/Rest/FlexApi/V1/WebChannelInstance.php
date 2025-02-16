<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\FlexApi\V1;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $accountSid
 * @property string $flexFlowSid
 * @property string $sid
 * @property string $url
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 */
class WebChannelInstance extends InstanceResource
{
    /**
     * Initialize the WebChannelInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The SID of the WebChannel resource to fetch
     */
    public function __construct(Version $version, array $payload, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'flexFlowSid' => Values::array_get($payload, 'flex_flow_sid'), 'sid' => Values::array_get($payload, 'sid'), 'url' => Values::array_get($payload, 'url'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated'))];
        $this->solution = ['sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return WebChannelContext Context for this WebChannelInstance
     */
    protected function proxy() : WebChannelContext
    {
        if (!$this->context) {
            $this->context = new WebChannelContext($this->version, $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the WebChannelInstance
     *
     * @return WebChannelInstance Fetched WebChannelInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : WebChannelInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Update the WebChannelInstance
     *
     * @param array|Options $options Optional Arguments
     * @return WebChannelInstance Updated WebChannelInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []) : WebChannelInstance
    {
        return $this->proxy()->update($options);
    }
    /**
     * Delete the WebChannelInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() : bool
    {
        return $this->proxy()->delete();
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
        return '[Twilio.FlexApi.V1.WebChannelInstance ' . \implode(' ', $context) . ']';
    }
}
