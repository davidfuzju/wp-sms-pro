<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\Understand\Assistant;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class AssistantFallbackActionsOptions
{
    /**
     * @param array $fallbackActions The fallback_actions
     * @return UpdateAssistantFallbackActionsOptions Options builder
     */
    public static function update(array $fallbackActions = Values::ARRAY_NONE) : UpdateAssistantFallbackActionsOptions
    {
        return new UpdateAssistantFallbackActionsOptions($fallbackActions);
    }
}
class UpdateAssistantFallbackActionsOptions extends Options
{
    /**
     * @param array $fallbackActions The fallback_actions
     */
    public function __construct(array $fallbackActions = Values::ARRAY_NONE)
    {
        $this->options['fallbackActions'] = $fallbackActions;
    }
    /**
     * The fallback_actions
     *
     * @param array $fallbackActions The fallback_actions
     * @return $this Fluent Builder
     */
    public function setFallbackActions(array $fallbackActions) : self
    {
        $this->options['fallbackActions'] = $fallbackActions;
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
        return '[Twilio.Preview.Understand.UpdateAssistantFallbackActionsOptions ' . $options . ']';
    }
}
