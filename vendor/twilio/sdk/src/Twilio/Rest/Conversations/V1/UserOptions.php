<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Conversations\V1;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class UserOptions
{
    /**
     * @param string $friendlyName The string that you assigned to describe the
     *                             resource
     * @param string $attributes The JSON Object string that stores
     *                           application-specific data
     * @param string $roleSid The SID of a service-level Role to assign to the user
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return CreateUserOptions Options builder
     */
    public static function create(string $friendlyName = Values::NONE, string $attributes = Values::NONE, string $roleSid = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE) : CreateUserOptions
    {
        return new CreateUserOptions($friendlyName, $attributes, $roleSid, $xTwilioWebhookEnabled);
    }
    /**
     * @param string $friendlyName The string that you assigned to describe the
     *                             resource
     * @param string $attributes The JSON Object string that stores
     *                           application-specific data
     * @param string $roleSid The SID of a service-level Role to assign to the user
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return UpdateUserOptions Options builder
     */
    public static function update(string $friendlyName = Values::NONE, string $attributes = Values::NONE, string $roleSid = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE) : UpdateUserOptions
    {
        return new UpdateUserOptions($friendlyName, $attributes, $roleSid, $xTwilioWebhookEnabled);
    }
    /**
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return DeleteUserOptions Options builder
     */
    public static function delete(string $xTwilioWebhookEnabled = Values::NONE) : DeleteUserOptions
    {
        return new DeleteUserOptions($xTwilioWebhookEnabled);
    }
}
class CreateUserOptions extends Options
{
    /**
     * @param string $friendlyName The string that you assigned to describe the
     *                             resource
     * @param string $attributes The JSON Object string that stores
     *                           application-specific data
     * @param string $roleSid The SID of a service-level Role to assign to the user
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     */
    public function __construct(string $friendlyName = Values::NONE, string $attributes = Values::NONE, string $roleSid = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['attributes'] = $attributes;
        $this->options['roleSid'] = $roleSid;
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
    }
    /**
     * The string that you assigned to describe the resource.
     *
     * @param string $friendlyName The string that you assigned to describe the
     *                             resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * The JSON Object string that stores application-specific data. If attributes have not been set, `{}` is returned.
     *
     * @param string $attributes The JSON Object string that stores
     *                           application-specific data
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes) : self
    {
        $this->options['attributes'] = $attributes;
        return $this;
    }
    /**
     * The SID of a service-level [Role](https://www.twilio.com/docs/conversations/api/role-resource) to assign to the user.
     *
     * @param string $roleSid The SID of a service-level Role to assign to the user
     * @return $this Fluent Builder
     */
    public function setRoleSid(string $roleSid) : self
    {
        $this->options['roleSid'] = $roleSid;
        return $this;
    }
    /**
     * The X-Twilio-Webhook-Enabled HTTP request header
     *
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return $this Fluent Builder
     */
    public function setXTwilioWebhookEnabled(string $xTwilioWebhookEnabled) : self
    {
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
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
        return '[Twilio.Conversations.V1.CreateUserOptions ' . $options . ']';
    }
}
class UpdateUserOptions extends Options
{
    /**
     * @param string $friendlyName The string that you assigned to describe the
     *                             resource
     * @param string $attributes The JSON Object string that stores
     *                           application-specific data
     * @param string $roleSid The SID of a service-level Role to assign to the user
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     */
    public function __construct(string $friendlyName = Values::NONE, string $attributes = Values::NONE, string $roleSid = Values::NONE, string $xTwilioWebhookEnabled = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['attributes'] = $attributes;
        $this->options['roleSid'] = $roleSid;
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
    }
    /**
     * The string that you assigned to describe the resource.
     *
     * @param string $friendlyName The string that you assigned to describe the
     *                             resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * The JSON Object string that stores application-specific data. If attributes have not been set, `{}` is returned.
     *
     * @param string $attributes The JSON Object string that stores
     *                           application-specific data
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes) : self
    {
        $this->options['attributes'] = $attributes;
        return $this;
    }
    /**
     * The SID of a service-level [Role](https://www.twilio.com/docs/conversations/api/role-resource) to assign to the user.
     *
     * @param string $roleSid The SID of a service-level Role to assign to the user
     * @return $this Fluent Builder
     */
    public function setRoleSid(string $roleSid) : self
    {
        $this->options['roleSid'] = $roleSid;
        return $this;
    }
    /**
     * The X-Twilio-Webhook-Enabled HTTP request header
     *
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return $this Fluent Builder
     */
    public function setXTwilioWebhookEnabled(string $xTwilioWebhookEnabled) : self
    {
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
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
        return '[Twilio.Conversations.V1.UpdateUserOptions ' . $options . ']';
    }
}
class DeleteUserOptions extends Options
{
    /**
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     */
    public function __construct(string $xTwilioWebhookEnabled = Values::NONE)
    {
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
    }
    /**
     * The X-Twilio-Webhook-Enabled HTTP request header
     *
     * @param string $xTwilioWebhookEnabled The X-Twilio-Webhook-Enabled HTTP
     *                                      request header
     * @return $this Fluent Builder
     */
    public function setXTwilioWebhookEnabled(string $xTwilioWebhookEnabled) : self
    {
        $this->options['xTwilioWebhookEnabled'] = $xTwilioWebhookEnabled;
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
        return '[Twilio.Conversations.V1.DeleteUserOptions ' . $options . ']';
    }
}
