<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Media\V1;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $accountSid
 * @property string $sid
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $extension
 * @property string $extensionContext
 * @property string $status
 * @property string $url
 * @property string $endedReason
 * @property string $statusCallback
 * @property string $statusCallbackMethod
 * @property int $maxDuration
 */
class MediaProcessorInstance extends InstanceResource
{
    /**
     * Initialize the MediaProcessorInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function __construct(Version $version, array $payload, string $sid = null)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['accountSid' => Values::array_get($payload, 'account_sid'), 'sid' => Values::array_get($payload, 'sid'), 'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')), 'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')), 'extension' => Values::array_get($payload, 'extension'), 'extensionContext' => Values::array_get($payload, 'extension_context'), 'status' => Values::array_get($payload, 'status'), 'url' => Values::array_get($payload, 'url'), 'endedReason' => Values::array_get($payload, 'ended_reason'), 'statusCallback' => Values::array_get($payload, 'status_callback'), 'statusCallbackMethod' => Values::array_get($payload, 'status_callback_method'), 'maxDuration' => Values::array_get($payload, 'max_duration')];
        $this->solution = ['sid' => $sid ?: $this->properties['sid']];
    }
    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return MediaProcessorContext Context for this MediaProcessorInstance
     */
    protected function proxy() : MediaProcessorContext
    {
        if (!$this->context) {
            $this->context = new MediaProcessorContext($this->version, $this->solution['sid']);
        }
        return $this->context;
    }
    /**
     * Fetch the MediaProcessorInstance
     *
     * @return MediaProcessorInstance Fetched MediaProcessorInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() : MediaProcessorInstance
    {
        return $this->proxy()->fetch();
    }
    /**
     * Update the MediaProcessorInstance
     *
     * @param string $status The status of the MediaProcessor
     * @return MediaProcessorInstance Updated MediaProcessorInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(string $status) : MediaProcessorInstance
    {
        return $this->proxy()->update($status);
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
        return '[Twilio.Media.V1.MediaProcessorInstance ' . \implode(' ', $context) . ']';
    }
}
