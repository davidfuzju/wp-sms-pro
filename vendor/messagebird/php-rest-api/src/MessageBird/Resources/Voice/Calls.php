<?php

namespace WPSmsPro\Vendor\MessageBird\Resources\Voice;

use WPSmsPro\Vendor\MessageBird\Common;
use WPSmsPro\Vendor\MessageBird\Objects;
/**
 * Class Calls
 *
 * @package MessageBird\Resources\Voice
 */
class Calls extends Base
{
    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Voice\Call());
        $this->setResourceName('calls');
        parent::__construct($HttpClient);
    }
}
