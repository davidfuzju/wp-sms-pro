<?php

namespace WPSmsPro\Vendor\MessageBird\Resources;

use WPSmsPro\Vendor\MessageBird\Objects;
use WPSmsPro\Vendor\MessageBird\Common;
/**
 * Class Messages
 *
 * @package MessageBird\Resources
 */
class Messages extends Base
{
    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Message());
        $this->setResourceName('messages');
        parent::__construct($HttpClient);
    }
}
