<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Autopilot\V1\Assistant;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class TaskOptions
{
    /**
     * @param string $friendlyName descriptive string that you create to describe
     *                             the new resource
     * @param array $actions The JSON string that specifies the actions that
     *                       instruct the Assistant on how to perform the task
     * @param string $actionsUrl The URL from which the Assistant can fetch actions
     * @return CreateTaskOptions Options builder
     */
    public static function create(string $friendlyName = Values::NONE, array $actions = Values::ARRAY_NONE, string $actionsUrl = Values::NONE) : CreateTaskOptions
    {
        return new CreateTaskOptions($friendlyName, $actions, $actionsUrl);
    }
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @param array $actions The JSON string that specifies the actions that
     *                       instruct the Assistant on how to perform the task
     * @param string $actionsUrl The URL from which the Assistant can fetch actions
     * @return UpdateTaskOptions Options builder
     */
    public static function update(string $friendlyName = Values::NONE, string $uniqueName = Values::NONE, array $actions = Values::ARRAY_NONE, string $actionsUrl = Values::NONE) : UpdateTaskOptions
    {
        return new UpdateTaskOptions($friendlyName, $uniqueName, $actions, $actionsUrl);
    }
}
class CreateTaskOptions extends Options
{
    /**
     * @param string $friendlyName descriptive string that you create to describe
     *                             the new resource
     * @param array $actions The JSON string that specifies the actions that
     *                       instruct the Assistant on how to perform the task
     * @param string $actionsUrl The URL from which the Assistant can fetch actions
     */
    public function __construct(string $friendlyName = Values::NONE, array $actions = Values::ARRAY_NONE, string $actionsUrl = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['actions'] = $actions;
        $this->options['actionsUrl'] = $actionsUrl;
    }
    /**
     * A descriptive string that you create to describe the new resource. It is not unique and can be up to 255 characters long.
     *
     * @param string $friendlyName descriptive string that you create to describe
     *                             the new resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * The JSON string that specifies the [actions](https://www.twilio.com/docs/autopilot/actions) that instruct the Assistant on how to perform the task. It is optional and not unique.
     *
     * @param array $actions The JSON string that specifies the actions that
     *                       instruct the Assistant on how to perform the task
     * @return $this Fluent Builder
     */
    public function setActions(array $actions) : self
    {
        $this->options['actions'] = $actions;
        return $this;
    }
    /**
     * The URL from which the Assistant can fetch actions.
     *
     * @param string $actionsUrl The URL from which the Assistant can fetch actions
     * @return $this Fluent Builder
     */
    public function setActionsUrl(string $actionsUrl) : self
    {
        $this->options['actionsUrl'] = $actionsUrl;
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
        return '[Twilio.Autopilot.V1.CreateTaskOptions ' . $options . ']';
    }
}
class UpdateTaskOptions extends Options
{
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @param array $actions The JSON string that specifies the actions that
     *                       instruct the Assistant on how to perform the task
     * @param string $actionsUrl The URL from which the Assistant can fetch actions
     */
    public function __construct(string $friendlyName = Values::NONE, string $uniqueName = Values::NONE, array $actions = Values::ARRAY_NONE, string $actionsUrl = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['uniqueName'] = $uniqueName;
        $this->options['actions'] = $actions;
        $this->options['actionsUrl'] = $actionsUrl;
    }
    /**
     * A descriptive string that you create to describe the resource. It is not unique and can be up to 255 characters long.
     *
     * @param string $friendlyName A string to describe the resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * An application-defined string that uniquely identifies the resource. This value must be 64 characters or less in length and be unique. It can be used as an alternative to the `sid` in the URL path to address the resource.
     *
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @return $this Fluent Builder
     */
    public function setUniqueName(string $uniqueName) : self
    {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }
    /**
     * The JSON string that specifies the [actions](https://www.twilio.com/docs/autopilot/actions) that instruct the Assistant on how to perform the task.
     *
     * @param array $actions The JSON string that specifies the actions that
     *                       instruct the Assistant on how to perform the task
     * @return $this Fluent Builder
     */
    public function setActions(array $actions) : self
    {
        $this->options['actions'] = $actions;
        return $this;
    }
    /**
     * The URL from which the Assistant can fetch actions.
     *
     * @param string $actionsUrl The URL from which the Assistant can fetch actions
     * @return $this Fluent Builder
     */
    public function setActionsUrl(string $actionsUrl) : self
    {
        $this->options['actionsUrl'] = $actionsUrl;
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
        return '[Twilio.Autopilot.V1.UpdateTaskOptions ' . $options . ']';
    }
}
