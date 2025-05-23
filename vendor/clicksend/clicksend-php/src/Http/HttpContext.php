<?php

/*
 * ClickSend
 *
 * This file was automatically generated for ClickSend by APIMATIC v2.0 ( https://apimatic.io ).
 */
namespace WPSmsPro\Vendor\ClickSendLib\Http;

/**
* Represents an Http call in context
*/
class HttpContext
{
    /**
     * Http request sent
     * @var HttpRequest
     */
    private $request = null;
    /**
     * Http response recevied
     * @var HttpResponse
     */
    private $response = null;
    /**
     * Create an instance of HttpContext for an Http Call
     * @param HttpRequest  $request  Request first sent on http call
     * @param HttpResponse $response Response received from http call
     */
    public function __construct(HttpRequest $request, HttpResponse $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    /**
     * Getter for the Http Request
     * @return HttpRequest request
     */
    public function getRequest()
    {
        return $this->request;
    }
    /**
     * Getter for the Http Response
     * @return HttpResponse response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
