<?php

namespace WP_SMS\Pro\Services\RestApi\Exceptions;

class SendRestResponse extends \Exception
{
    /**
     * Response data
     *
     * @var array
     */
    private $data;
    /**
     * Constructor
     *
     * @param mixed $data
     * @param integer $code
     */
    public function __construct($data, $code)
    {
        $this->data = $data;
        $this->code = $code;
    }
    public function getData()
    {
        return $this->data;
    }
}
