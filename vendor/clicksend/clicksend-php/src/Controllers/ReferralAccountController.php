<?php

/*
 * ClickSend
 *
 * This file was automatically generated for ClickSend by APIMATIC v2.0 ( https://apimatic.io ).
 */
namespace WPSmsPro\Vendor\ClickSendLib\Controllers;

use WPSmsPro\Vendor\ClickSendLib\APIException;
use WPSmsPro\Vendor\ClickSendLib\APIHelper;
use WPSmsPro\Vendor\ClickSendLib\Configuration;
use WPSmsPro\Vendor\ClickSendLib\Models;
use WPSmsPro\Vendor\ClickSendLib\Exceptions;
use WPSmsPro\Vendor\ClickSendLib\Http\HttpRequest;
use WPSmsPro\Vendor\ClickSendLib\Http\HttpResponse;
use WPSmsPro\Vendor\ClickSendLib\Http\HttpMethod;
use WPSmsPro\Vendor\ClickSendLib\Http\HttpContext;
use WPSmsPro\Vendor\Unirest\Request;
/**
 * @todo Add a general description for this controller.
 */
class ReferralAccountController extends BaseController
{
    /**
     * @var ReferralAccountController The reference to *Singleton* instance of this class
     */
    private static $instance;
    /**
     * Returns the *Singleton* instance of this class.
     * @return ReferralAccountController The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }
    /**
     * Get all referral accounts
     *
     * @return string response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getReferralAccounts()
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;
        //prepare query string for API call
        $_queryBuilder = $_queryBuilder . '/referral/accounts';
        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);
        //prepare headers
        $_headers = array('user-agent' => 'ClickSendSDK');
        //set HTTP basic auth parameters
        Request::auth(Configuration::$username, Configuration::$key);
        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }
        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);
        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);
        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }
        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);
        return $response->body;
    }
}
