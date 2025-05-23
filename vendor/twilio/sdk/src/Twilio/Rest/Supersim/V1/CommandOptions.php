<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Supersim\V1;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class CommandOptions
{
    /**
     * @param string $callbackMethod The HTTP method we should use to call
     *                               callback_url
     * @param string $callbackUrl The URL we should call after we have sent the
     *                            command
     * @return CreateCommandOptions Options builder
     */
    public static function create(string $callbackMethod = Values::NONE, string $callbackUrl = Values::NONE) : CreateCommandOptions
    {
        return new CreateCommandOptions($callbackMethod, $callbackUrl);
    }
    /**
     * @param string $sim The SID or unique name of the Sim that Command was sent
     *                    to or from.
     * @param string $status The status of the Command
     * @param string $direction The direction of the Command
     * @return ReadCommandOptions Options builder
     */
    public static function read(string $sim = Values::NONE, string $status = Values::NONE, string $direction = Values::NONE) : ReadCommandOptions
    {
        return new ReadCommandOptions($sim, $status, $direction);
    }
}
class CreateCommandOptions extends Options
{
    /**
     * @param string $callbackMethod The HTTP method we should use to call
     *                               callback_url
     * @param string $callbackUrl The URL we should call after we have sent the
     *                            command
     */
    public function __construct(string $callbackMethod = Values::NONE, string $callbackUrl = Values::NONE)
    {
        $this->options['callbackMethod'] = $callbackMethod;
        $this->options['callbackUrl'] = $callbackUrl;
    }
    /**
     * The HTTP method we should use to call `callback_url`. Can be: `GET` or `POST` and the default is POST.
     *
     * @param string $callbackMethod The HTTP method we should use to call
     *                               callback_url
     * @return $this Fluent Builder
     */
    public function setCallbackMethod(string $callbackMethod) : self
    {
        $this->options['callbackMethod'] = $callbackMethod;
        return $this;
    }
    /**
     * The URL we should call using the `callback_method` after we have sent the command.
     *
     * @param string $callbackUrl The URL we should call after we have sent the
     *                            command
     * @return $this Fluent Builder
     */
    public function setCallbackUrl(string $callbackUrl) : self
    {
        $this->options['callbackUrl'] = $callbackUrl;
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
        return '[Twilio.Supersim.V1.CreateCommandOptions ' . $options . ']';
    }
}
class ReadCommandOptions extends Options
{
    /**
     * @param string $sim The SID or unique name of the Sim that Command was sent
     *                    to or from.
     * @param string $status The status of the Command
     * @param string $direction The direction of the Command
     */
    public function __construct(string $sim = Values::NONE, string $status = Values::NONE, string $direction = Values::NONE)
    {
        $this->options['sim'] = $sim;
        $this->options['status'] = $status;
        $this->options['direction'] = $direction;
    }
    /**
     * The SID or unique name of the Sim that Command was sent to or from.
     *
     * @param string $sim The SID or unique name of the Sim that Command was sent
     *                    to or from.
     * @return $this Fluent Builder
     */
    public function setSim(string $sim) : self
    {
        $this->options['sim'] = $sim;
        return $this;
    }
    /**
     * The status of the Command. Can be: `queued`, `sent`, `delivered`, `received` or `failed`. See the [Command Status Values](https://www.twilio.com/docs/wireless/api/command-resource#status-values) for a description of each.
     *
     * @param string $status The status of the Command
     * @return $this Fluent Builder
     */
    public function setStatus(string $status) : self
    {
        $this->options['status'] = $status;
        return $this;
    }
    /**
     * The direction of the Command. Can be `to_sim` or `from_sim`. The value of `to_sim` is synonymous with the term `mobile terminated`, and `from_sim` is synonymous with the term `mobile originated`.
     *
     * @param string $direction The direction of the Command
     * @return $this Fluent Builder
     */
    public function setDirection(string $direction) : self
    {
        $this->options['direction'] = $direction;
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
        return '[Twilio.Supersim.V1.ReadCommandOptions ' . $options . ']';
    }
}
