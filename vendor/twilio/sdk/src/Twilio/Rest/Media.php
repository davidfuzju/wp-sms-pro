<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest;

use WPSmsPro\Vendor\Twilio\Domain;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\Rest\Media\V1;
/**
 * @property \Twilio\Rest\Media\V1 $v1
 * @property \Twilio\Rest\Media\V1\MediaProcessorList $mediaProcessor
 * @property \Twilio\Rest\Media\V1\PlayerStreamerList $playerStreamer
 * @method \Twilio\Rest\Media\V1\MediaProcessorContext mediaProcessor(string $sid)
 * @method \Twilio\Rest\Media\V1\PlayerStreamerContext playerStreamer(string $sid)
 */
class Media extends Domain
{
    protected $_v1;
    /**
     * Construct the Media Domain
     *
     * @param Client $client Client to communicate with Twilio
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->baseUrl = 'https://media.twilio.com';
    }
    /**
     * @return V1 Version v1 of media
     */
    protected function getV1() : V1
    {
        if (!$this->_v1) {
            $this->_v1 = new V1($this);
        }
        return $this->_v1;
    }
    /**
     * Magic getter to lazy load version
     *
     * @param string $name Version to return
     * @return \Twilio\Version The requested version
     * @throws TwilioException For unknown versions
     */
    public function __get(string $name)
    {
        $method = 'get' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return $this->{$method}();
        }
        throw new TwilioException('Unknown version ' . $name);
    }
    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments)
    {
        $method = 'context' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return \call_user_func_array([$this, $method], $arguments);
        }
        throw new TwilioException('Unknown context ' . $name);
    }
    protected function getMediaProcessor() : \WPSmsPro\Vendor\Twilio\Rest\Media\V1\MediaProcessorList
    {
        return $this->v1->mediaProcessor;
    }
    /**
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextMediaProcessor(string $sid) : \WPSmsPro\Vendor\Twilio\Rest\Media\V1\MediaProcessorContext
    {
        return $this->v1->mediaProcessor($sid);
    }
    protected function getPlayerStreamer() : \WPSmsPro\Vendor\Twilio\Rest\Media\V1\PlayerStreamerList
    {
        return $this->v1->playerStreamer;
    }
    /**
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextPlayerStreamer(string $sid) : \WPSmsPro\Vendor\Twilio\Rest\Media\V1\PlayerStreamerContext
    {
        return $this->v1->playerStreamer($sid);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Media]';
    }
}
