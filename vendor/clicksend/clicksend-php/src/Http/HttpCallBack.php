<?php

/*
 * ClickSend
 *
 * This file was automatically generated for ClickSend by APIMATIC v2.0 ( https://apimatic.io ).
 */
namespace WPSmsPro\Vendor\ClickSendLib\Http;

/**
* HttpCallBack allows defining callables for pre and post API calls.
*/
class HttpCallBack
{
    /**
     * Callable for on-before event of API calls
     * @var callable
     */
    private $onBeforeRequest = null;
    /**
     * Callable for on-after event of API calls
     * @var callable
     */
    private $onAfterRequest = null;
    /**
     * Create a new HttpCallBack instance
     * @param callable|null $onBeforeRequest Called before an API call
     * @param callable|null $onAfterRequest  Called after an API call
     */
    public function __construct(callable $onBeforeRequest = null, callable $onAfterRequest = null)
    {
        $this->onBeforeRequest = $onBeforeRequest;
        $this->onAfterRequest = $onAfterRequest;
    }
    /**
     * Set on-before event callback
     * @param callable $func On-before event callable
     */
    public function setOnBeforeRequest(callable $func)
    {
        $this->onBeforeRequest = $func;
    }
    /**
     * Get On-before API call event callable
     * @return callable Callable
     */
    public function getOnBeforeRequest()
    {
        return $this->onBeforeRequest;
    }
    /**
     * Set On-after API call event callable
     * @param callable $func On-after event callable
     */
    public function setOnAfterRequest(callable $func)
    {
        $this->onAfterRequest = $func;
    }
    /**
     * Get On-After API call event callable
     * @return callable On-after event callable
     */
    public function getOnAfterRequest()
    {
        return $this->onAfterRequest;
    }
    /**
     * Call on-before event callable
     * @param  HttpRequest $httpRequest HttpRequest for this call
     */
    public function callOnBeforeRequest(HttpRequest $httpRequest)
    {
        if ($this->onBeforeRequest != null) {
            \call_user_func($this->onBeforeRequest, $httpRequest);
        }
    }
    /**
     * Call on-after event callable
     * @param  HttpRequest $httpRequest HttpRequest for this call
     */
    public function callOnAfterRequest(HttpContext $httpContext)
    {
        if ($this->onAfterRequest != null) {
            \call_user_func($this->onAfterRequest, $httpContext);
        }
    }
}
