<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Api\V2010\Account;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class ValidationRequestOptions
{
    /**
     * @param string $friendlyName A string to describe the resource
     * @param int $callDelay The number of seconds to delay before initiating the
     *                       verification call
     * @param string $extension The digits to dial after connecting the
     *                          verification call
     * @param string $statusCallback The URL we should call to send status
     *                               information to your application
     * @param string $statusCallbackMethod The HTTP method we should use to call
     *                                     status_callback
     * @return CreateValidationRequestOptions Options builder
     */
    public static function create(string $friendlyName = Values::NONE, int $callDelay = Values::NONE, string $extension = Values::NONE, string $statusCallback = Values::NONE, string $statusCallbackMethod = Values::NONE) : CreateValidationRequestOptions
    {
        return new CreateValidationRequestOptions($friendlyName, $callDelay, $extension, $statusCallback, $statusCallbackMethod);
    }
}
class CreateValidationRequestOptions extends Options
{
    /**
     * @param string $friendlyName A string to describe the resource
     * @param int $callDelay The number of seconds to delay before initiating the
     *                       verification call
     * @param string $extension The digits to dial after connecting the
     *                          verification call
     * @param string $statusCallback The URL we should call to send status
     *                               information to your application
     * @param string $statusCallbackMethod The HTTP method we should use to call
     *                                     status_callback
     */
    public function __construct(string $friendlyName = Values::NONE, int $callDelay = Values::NONE, string $extension = Values::NONE, string $statusCallback = Values::NONE, string $statusCallbackMethod = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['callDelay'] = $callDelay;
        $this->options['extension'] = $extension;
        $this->options['statusCallback'] = $statusCallback;
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
    }
    /**
     * A descriptive string that you create to describe the new caller ID resource. It can be up to 64 characters long. The default value is a formatted version of the phone number.
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
     * The number of seconds to delay before initiating the verification call. Can be an integer between `0` and `60`, inclusive. The default is `0`.
     *
     * @param int $callDelay The number of seconds to delay before initiating the
     *                       verification call
     * @return $this Fluent Builder
     */
    public function setCallDelay(int $callDelay) : self
    {
        $this->options['callDelay'] = $callDelay;
        return $this;
    }
    /**
     * The digits to dial after connecting the verification call.
     *
     * @param string $extension The digits to dial after connecting the
     *                          verification call
     * @return $this Fluent Builder
     */
    public function setExtension(string $extension) : self
    {
        $this->options['extension'] = $extension;
        return $this;
    }
    /**
     * The URL we should call using the `status_callback_method` to send status information about the verification process to your application.
     *
     * @param string $statusCallback The URL we should call to send status
     *                               information to your application
     * @return $this Fluent Builder
     */
    public function setStatusCallback(string $statusCallback) : self
    {
        $this->options['statusCallback'] = $statusCallback;
        return $this;
    }
    /**
     * The HTTP method we should use to call `status_callback`. Can be: `GET` or `POST`, and the default is `POST`.
     *
     * @param string $statusCallbackMethod The HTTP method we should use to call
     *                                     status_callback
     * @return $this Fluent Builder
     */
    public function setStatusCallbackMethod(string $statusCallbackMethod) : self
    {
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
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
        return '[Twilio.Api.V2010.CreateValidationRequestOptions ' . $options . ']';
    }
}
