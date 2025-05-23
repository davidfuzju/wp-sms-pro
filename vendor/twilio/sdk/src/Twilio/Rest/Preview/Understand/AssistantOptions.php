<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Understand;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class AssistantOptions
{
    /**
     * @param string $friendlyName A text description for the Assistant. It is
     *                             non-unique and can up to 255 characters long.
     * @param bool $logQueries A boolean that specifies whether queries should be
     *                         logged for 30 days further training. If false, no
     *                         queries will be stored, if true, queries will be
     *                         stored for 30 days and deleted thereafter. Defaults
     *                         to true if no value is provided.
     * @param string $uniqueName A user-provided string that uniquely identifies
     *                           this resource as an alternative to the sid. Unique
     *                           up to 64 characters long.
     * @param string $callbackUrl A user-provided URL to send event callbacks to.
     * @param string $callbackEvents Space-separated list of callback events that
     *                               will trigger callbacks.
     * @param array $fallbackActions The JSON actions to be executed when the
     *                               user's input is not recognized as matching any
     *                               Task.
     * @param array $initiationActions The JSON actions to be executed on inbound
     *                                 phone calls when the Assistant has to say
     *                                 something first.
     * @param array $styleSheet The JSON object that holds the style sheet for the
     *                          assistant
     * @return CreateAssistantOptions Options builder
     */
    public static function create(string $friendlyName = Values::NONE, bool $logQueries = Values::NONE, string $uniqueName = Values::NONE, string $callbackUrl = Values::NONE, string $callbackEvents = Values::NONE, array $fallbackActions = Values::ARRAY_NONE, array $initiationActions = Values::ARRAY_NONE, array $styleSheet = Values::ARRAY_NONE) : CreateAssistantOptions
    {
        return new CreateAssistantOptions($friendlyName, $logQueries, $uniqueName, $callbackUrl, $callbackEvents, $fallbackActions, $initiationActions, $styleSheet);
    }
    /**
     * @param string $friendlyName A text description for the Assistant. It is
     *                             non-unique and can up to 255 characters long.
     * @param bool $logQueries A boolean that specifies whether queries should be
     *                         logged for 30 days further training. If false, no
     *                         queries will be stored, if true, queries will be
     *                         stored for 30 days and deleted thereafter. Defaults
     *                         to true if no value is provided.
     * @param string $uniqueName A user-provided string that uniquely identifies
     *                           this resource as an alternative to the sid. Unique
     *                           up to 64 characters long.
     * @param string $callbackUrl A user-provided URL to send event callbacks to.
     * @param string $callbackEvents Space-separated list of callback events that
     *                               will trigger callbacks.
     * @param array $fallbackActions The JSON actions to be executed when the
     *                               user's input is not recognized as matching any
     *                               Task.
     * @param array $initiationActions The JSON actions to be executed on inbound
     *                                 phone calls when the Assistant has to say
     *                                 something first.
     * @param array $styleSheet The JSON object that holds the style sheet for the
     *                          assistant
     * @return UpdateAssistantOptions Options builder
     */
    public static function update(string $friendlyName = Values::NONE, bool $logQueries = Values::NONE, string $uniqueName = Values::NONE, string $callbackUrl = Values::NONE, string $callbackEvents = Values::NONE, array $fallbackActions = Values::ARRAY_NONE, array $initiationActions = Values::ARRAY_NONE, array $styleSheet = Values::ARRAY_NONE) : UpdateAssistantOptions
    {
        return new UpdateAssistantOptions($friendlyName, $logQueries, $uniqueName, $callbackUrl, $callbackEvents, $fallbackActions, $initiationActions, $styleSheet);
    }
}
class CreateAssistantOptions extends Options
{
    /**
     * @param string $friendlyName A text description for the Assistant. It is
     *                             non-unique and can up to 255 characters long.
     * @param bool $logQueries A boolean that specifies whether queries should be
     *                         logged for 30 days further training. If false, no
     *                         queries will be stored, if true, queries will be
     *                         stored for 30 days and deleted thereafter. Defaults
     *                         to true if no value is provided.
     * @param string $uniqueName A user-provided string that uniquely identifies
     *                           this resource as an alternative to the sid. Unique
     *                           up to 64 characters long.
     * @param string $callbackUrl A user-provided URL to send event callbacks to.
     * @param string $callbackEvents Space-separated list of callback events that
     *                               will trigger callbacks.
     * @param array $fallbackActions The JSON actions to be executed when the
     *                               user's input is not recognized as matching any
     *                               Task.
     * @param array $initiationActions The JSON actions to be executed on inbound
     *                                 phone calls when the Assistant has to say
     *                                 something first.
     * @param array $styleSheet The JSON object that holds the style sheet for the
     *                          assistant
     */
    public function __construct(string $friendlyName = Values::NONE, bool $logQueries = Values::NONE, string $uniqueName = Values::NONE, string $callbackUrl = Values::NONE, string $callbackEvents = Values::NONE, array $fallbackActions = Values::ARRAY_NONE, array $initiationActions = Values::ARRAY_NONE, array $styleSheet = Values::ARRAY_NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['logQueries'] = $logQueries;
        $this->options['uniqueName'] = $uniqueName;
        $this->options['callbackUrl'] = $callbackUrl;
        $this->options['callbackEvents'] = $callbackEvents;
        $this->options['fallbackActions'] = $fallbackActions;
        $this->options['initiationActions'] = $initiationActions;
        $this->options['styleSheet'] = $styleSheet;
    }
    /**
     * A text description for the Assistant. It is non-unique and can up to 255 characters long.
     *
     * @param string $friendlyName A text description for the Assistant. It is
     *                             non-unique and can up to 255 characters long.
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * A boolean that specifies whether queries should be logged for 30 days further training. If false, no queries will be stored, if true, queries will be stored for 30 days and deleted thereafter. Defaults to true if no value is provided.
     *
     * @param bool $logQueries A boolean that specifies whether queries should be
     *                         logged for 30 days further training. If false, no
     *                         queries will be stored, if true, queries will be
     *                         stored for 30 days and deleted thereafter. Defaults
     *                         to true if no value is provided.
     * @return $this Fluent Builder
     */
    public function setLogQueries(bool $logQueries) : self
    {
        $this->options['logQueries'] = $logQueries;
        return $this;
    }
    /**
     * A user-provided string that uniquely identifies this resource as an alternative to the sid. Unique up to 64 characters long.
     *
     * @param string $uniqueName A user-provided string that uniquely identifies
     *                           this resource as an alternative to the sid. Unique
     *                           up to 64 characters long.
     * @return $this Fluent Builder
     */
    public function setUniqueName(string $uniqueName) : self
    {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }
    /**
     * A user-provided URL to send event callbacks to.
     *
     * @param string $callbackUrl A user-provided URL to send event callbacks to.
     * @return $this Fluent Builder
     */
    public function setCallbackUrl(string $callbackUrl) : self
    {
        $this->options['callbackUrl'] = $callbackUrl;
        return $this;
    }
    /**
     * Space-separated list of callback events that will trigger callbacks.
     *
     * @param string $callbackEvents Space-separated list of callback events that
     *                               will trigger callbacks.
     * @return $this Fluent Builder
     */
    public function setCallbackEvents(string $callbackEvents) : self
    {
        $this->options['callbackEvents'] = $callbackEvents;
        return $this;
    }
    /**
     * The JSON actions to be executed when the user's input is not recognized as matching any Task.
     *
     * @param array $fallbackActions The JSON actions to be executed when the
     *                               user's input is not recognized as matching any
     *                               Task.
     * @return $this Fluent Builder
     */
    public function setFallbackActions(array $fallbackActions) : self
    {
        $this->options['fallbackActions'] = $fallbackActions;
        return $this;
    }
    /**
     * The JSON actions to be executed on inbound phone calls when the Assistant has to say something first.
     *
     * @param array $initiationActions The JSON actions to be executed on inbound
     *                                 phone calls when the Assistant has to say
     *                                 something first.
     * @return $this Fluent Builder
     */
    public function setInitiationActions(array $initiationActions) : self
    {
        $this->options['initiationActions'] = $initiationActions;
        return $this;
    }
    /**
     * The JSON object that holds the style sheet for the assistant
     *
     * @param array $styleSheet The JSON object that holds the style sheet for the
     *                          assistant
     * @return $this Fluent Builder
     */
    public function setStyleSheet(array $styleSheet) : self
    {
        $this->options['styleSheet'] = $styleSheet;
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
        return '[Twilio.Preview.Understand.CreateAssistantOptions ' . $options . ']';
    }
}
class UpdateAssistantOptions extends Options
{
    /**
     * @param string $friendlyName A text description for the Assistant. It is
     *                             non-unique and can up to 255 characters long.
     * @param bool $logQueries A boolean that specifies whether queries should be
     *                         logged for 30 days further training. If false, no
     *                         queries will be stored, if true, queries will be
     *                         stored for 30 days and deleted thereafter. Defaults
     *                         to true if no value is provided.
     * @param string $uniqueName A user-provided string that uniquely identifies
     *                           this resource as an alternative to the sid. Unique
     *                           up to 64 characters long.
     * @param string $callbackUrl A user-provided URL to send event callbacks to.
     * @param string $callbackEvents Space-separated list of callback events that
     *                               will trigger callbacks.
     * @param array $fallbackActions The JSON actions to be executed when the
     *                               user's input is not recognized as matching any
     *                               Task.
     * @param array $initiationActions The JSON actions to be executed on inbound
     *                                 phone calls when the Assistant has to say
     *                                 something first.
     * @param array $styleSheet The JSON object that holds the style sheet for the
     *                          assistant
     */
    public function __construct(string $friendlyName = Values::NONE, bool $logQueries = Values::NONE, string $uniqueName = Values::NONE, string $callbackUrl = Values::NONE, string $callbackEvents = Values::NONE, array $fallbackActions = Values::ARRAY_NONE, array $initiationActions = Values::ARRAY_NONE, array $styleSheet = Values::ARRAY_NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['logQueries'] = $logQueries;
        $this->options['uniqueName'] = $uniqueName;
        $this->options['callbackUrl'] = $callbackUrl;
        $this->options['callbackEvents'] = $callbackEvents;
        $this->options['fallbackActions'] = $fallbackActions;
        $this->options['initiationActions'] = $initiationActions;
        $this->options['styleSheet'] = $styleSheet;
    }
    /**
     * A text description for the Assistant. It is non-unique and can up to 255 characters long.
     *
     * @param string $friendlyName A text description for the Assistant. It is
     *                             non-unique and can up to 255 characters long.
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * A boolean that specifies whether queries should be logged for 30 days further training. If false, no queries will be stored, if true, queries will be stored for 30 days and deleted thereafter. Defaults to true if no value is provided.
     *
     * @param bool $logQueries A boolean that specifies whether queries should be
     *                         logged for 30 days further training. If false, no
     *                         queries will be stored, if true, queries will be
     *                         stored for 30 days and deleted thereafter. Defaults
     *                         to true if no value is provided.
     * @return $this Fluent Builder
     */
    public function setLogQueries(bool $logQueries) : self
    {
        $this->options['logQueries'] = $logQueries;
        return $this;
    }
    /**
     * A user-provided string that uniquely identifies this resource as an alternative to the sid. Unique up to 64 characters long.
     *
     * @param string $uniqueName A user-provided string that uniquely identifies
     *                           this resource as an alternative to the sid. Unique
     *                           up to 64 characters long.
     * @return $this Fluent Builder
     */
    public function setUniqueName(string $uniqueName) : self
    {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }
    /**
     * A user-provided URL to send event callbacks to.
     *
     * @param string $callbackUrl A user-provided URL to send event callbacks to.
     * @return $this Fluent Builder
     */
    public function setCallbackUrl(string $callbackUrl) : self
    {
        $this->options['callbackUrl'] = $callbackUrl;
        return $this;
    }
    /**
     * Space-separated list of callback events that will trigger callbacks.
     *
     * @param string $callbackEvents Space-separated list of callback events that
     *                               will trigger callbacks.
     * @return $this Fluent Builder
     */
    public function setCallbackEvents(string $callbackEvents) : self
    {
        $this->options['callbackEvents'] = $callbackEvents;
        return $this;
    }
    /**
     * The JSON actions to be executed when the user's input is not recognized as matching any Task.
     *
     * @param array $fallbackActions The JSON actions to be executed when the
     *                               user's input is not recognized as matching any
     *                               Task.
     * @return $this Fluent Builder
     */
    public function setFallbackActions(array $fallbackActions) : self
    {
        $this->options['fallbackActions'] = $fallbackActions;
        return $this;
    }
    /**
     * The JSON actions to be executed on inbound phone calls when the Assistant has to say something first.
     *
     * @param array $initiationActions The JSON actions to be executed on inbound
     *                                 phone calls when the Assistant has to say
     *                                 something first.
     * @return $this Fluent Builder
     */
    public function setInitiationActions(array $initiationActions) : self
    {
        $this->options['initiationActions'] = $initiationActions;
        return $this;
    }
    /**
     * The JSON object that holds the style sheet for the assistant
     *
     * @param array $styleSheet The JSON object that holds the style sheet for the
     *                          assistant
     * @return $this Fluent Builder
     */
    public function setStyleSheet(array $styleSheet) : self
    {
        $this->options['styleSheet'] = $styleSheet;
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
        return '[Twilio.Preview.Understand.UpdateAssistantOptions ' . $options . ']';
    }
}
