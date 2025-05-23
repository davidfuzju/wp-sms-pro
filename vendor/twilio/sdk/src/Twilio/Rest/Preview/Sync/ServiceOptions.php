<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Sync;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class ServiceOptions
{
    /**
     * @param string $friendlyName The friendly_name
     * @param string $webhookUrl The webhook_url
     * @param bool $reachabilityWebhooksEnabled The reachability_webhooks_enabled
     * @param bool $aclEnabled The acl_enabled
     * @return CreateServiceOptions Options builder
     */
    public static function create(string $friendlyName = Values::NONE, string $webhookUrl = Values::NONE, bool $reachabilityWebhooksEnabled = Values::NONE, bool $aclEnabled = Values::NONE) : CreateServiceOptions
    {
        return new CreateServiceOptions($friendlyName, $webhookUrl, $reachabilityWebhooksEnabled, $aclEnabled);
    }
    /**
     * @param string $webhookUrl The webhook_url
     * @param string $friendlyName The friendly_name
     * @param bool $reachabilityWebhooksEnabled The reachability_webhooks_enabled
     * @param bool $aclEnabled The acl_enabled
     * @return UpdateServiceOptions Options builder
     */
    public static function update(string $webhookUrl = Values::NONE, string $friendlyName = Values::NONE, bool $reachabilityWebhooksEnabled = Values::NONE, bool $aclEnabled = Values::NONE) : UpdateServiceOptions
    {
        return new UpdateServiceOptions($webhookUrl, $friendlyName, $reachabilityWebhooksEnabled, $aclEnabled);
    }
}
class CreateServiceOptions extends Options
{
    /**
     * @param string $friendlyName The friendly_name
     * @param string $webhookUrl The webhook_url
     * @param bool $reachabilityWebhooksEnabled The reachability_webhooks_enabled
     * @param bool $aclEnabled The acl_enabled
     */
    public function __construct(string $friendlyName = Values::NONE, string $webhookUrl = Values::NONE, bool $reachabilityWebhooksEnabled = Values::NONE, bool $aclEnabled = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['webhookUrl'] = $webhookUrl;
        $this->options['reachabilityWebhooksEnabled'] = $reachabilityWebhooksEnabled;
        $this->options['aclEnabled'] = $aclEnabled;
    }
    /**
     * The friendly_name
     *
     * @param string $friendlyName The friendly_name
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * The webhook_url
     *
     * @param string $webhookUrl The webhook_url
     * @return $this Fluent Builder
     */
    public function setWebhookUrl(string $webhookUrl) : self
    {
        $this->options['webhookUrl'] = $webhookUrl;
        return $this;
    }
    /**
     * The reachability_webhooks_enabled
     *
     * @param bool $reachabilityWebhooksEnabled The reachability_webhooks_enabled
     * @return $this Fluent Builder
     */
    public function setReachabilityWebhooksEnabled(bool $reachabilityWebhooksEnabled) : self
    {
        $this->options['reachabilityWebhooksEnabled'] = $reachabilityWebhooksEnabled;
        return $this;
    }
    /**
     * The acl_enabled
     *
     * @param bool $aclEnabled The acl_enabled
     * @return $this Fluent Builder
     */
    public function setAclEnabled(bool $aclEnabled) : self
    {
        $this->options['aclEnabled'] = $aclEnabled;
        return $this;
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Preview.Sync.CreateServiceOptions ' . $options . ']';
    }
}
class UpdateServiceOptions extends Options
{
    /**
     * @param string $webhookUrl The webhook_url
     * @param string $friendlyName The friendly_name
     * @param bool $reachabilityWebhooksEnabled The reachability_webhooks_enabled
     * @param bool $aclEnabled The acl_enabled
     */
    public function __construct(string $webhookUrl = Values::NONE, string $friendlyName = Values::NONE, bool $reachabilityWebhooksEnabled = Values::NONE, bool $aclEnabled = Values::NONE)
    {
        $this->options['webhookUrl'] = $webhookUrl;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['reachabilityWebhooksEnabled'] = $reachabilityWebhooksEnabled;
        $this->options['aclEnabled'] = $aclEnabled;
    }
    /**
     * The webhook_url
     *
     * @param string $webhookUrl The webhook_url
     * @return $this Fluent Builder
     */
    public function setWebhookUrl(string $webhookUrl) : self
    {
        $this->options['webhookUrl'] = $webhookUrl;
        return $this;
    }
    /**
     * The friendly_name
     *
     * @param string $friendlyName The friendly_name
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * The reachability_webhooks_enabled
     *
     * @param bool $reachabilityWebhooksEnabled The reachability_webhooks_enabled
     * @return $this Fluent Builder
     */
    public function setReachabilityWebhooksEnabled(bool $reachabilityWebhooksEnabled) : self
    {
        $this->options['reachabilityWebhooksEnabled'] = $reachabilityWebhooksEnabled;
        return $this;
    }
    /**
     * The acl_enabled
     *
     * @param bool $aclEnabled The acl_enabled
     * @return $this Fluent Builder
     */
    public function setAclEnabled(bool $aclEnabled) : self
    {
        $this->options['aclEnabled'] = $aclEnabled;
        return $this;
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Preview.Sync.UpdateServiceOptions ' . $options . ']';
    }
}
