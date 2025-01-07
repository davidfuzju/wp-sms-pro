<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1\Service;

use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\ListResource;
use WPSmsPro\Vendor\Twilio\Rest\Conversations\V1\Service\Configuration\NotificationList;
use WPSmsPro\Vendor\Twilio\Rest\Conversations\V1\Service\Configuration\WebhookList;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property NotificationList $notifications
 * @property WebhookList $webhooks
 * @method \Twilio\Rest\Conversations\V1\Service\Configuration\NotificationContext notifications()
 * @method \Twilio\Rest\Conversations\V1\Service\Configuration\WebhookContext webhooks()
 */
class ConfigurationList extends ListResource
{
    protected $_notifications = null;
    protected $_webhooks = null;
    /**
     * Construct the ConfigurationList
     *
     * @param Version $version Version that contains the resource
     * @param string $chatServiceSid The unique string that identifies the resource
     */
    public function __construct(Version $version, string $chatServiceSid)
    {
        parent::__construct($version);
        // Path Solution
        $this->solution = ['chatServiceSid' => $chatServiceSid];
    }
    /**
     * Access the notifications
     */
    protected function getNotifications() : NotificationList
    {
        if (!$this->_notifications) {
            $this->_notifications = new NotificationList($this->version, $this->solution['chatServiceSid']);
        }
        return $this->_notifications;
    }
    /**
     * Access the webhooks
     */
    protected function getWebhooks() : WebhookList
    {
        if (!$this->_webhooks) {
            $this->_webhooks = new WebhookList($this->version, $this->solution['chatServiceSid']);
        }
        return $this->_webhooks;
    }
    /**
     * Constructs a ConfigurationContext
     */
    public function getContext() : ConfigurationContext
    {
        return new ConfigurationContext($this->version, $this->solution['chatServiceSid']);
    }
    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get(string $name)
    {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->{$method}();
        }
        throw new TwilioException('Unknown subresource ' . $name);
    }
    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments) : InstanceContext
    {
        $property = $this->{$name};
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }
        throw new TwilioException('Resource does not have a context');
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Conversations.V1.ConfigurationList]';
    }
}
