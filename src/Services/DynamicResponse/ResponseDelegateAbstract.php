<?php

namespace WP_SMS\Pro\Services\DynamicResponse;

abstract class ResponseDelegateAbstract
{
    /**
     * @var array
     */
    protected $data;
    /**
     * @var Response
     */
    private $response;
    public function __construct($response, $data = [])
    {
        $this->response = $response;
        $this->data = $data;
    }
    /**
     * Get the parent response of this delegate
     *
     * @return Response
     */
    protected function getResponse()
    {
        return $this->response;
    }
    /**
     * Get injected data
     *
     * @param string $key if this parameter is left empty, all of the data will be returned
     * @return array|mixed|null
     */
    protected function getData($key = '')
    {
        if (empty($key)) {
            return $this->data;
        }
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
    /**
     * Check requirements before adding variables to the response
     *
     * @abstract
     * @return boolean
     */
    public abstract function checkRequirements();
    /**
     * Add variables to the response
     *
     * @abstract
     * @return void
     */
    public abstract function addDelegateVariables();
}
