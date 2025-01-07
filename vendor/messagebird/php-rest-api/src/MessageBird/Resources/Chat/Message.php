<?php

namespace WPSmsPro\Vendor\MessageBird\Resources\Chat;

use WPSmsPro\Vendor\MessageBird\Objects;
use WPSmsPro\Vendor\MessageBird\Common;
use WPSmsPro\Vendor\MessageBird\Resources\Base;
/**
 * Class Message
 *
 * @package MessageBird\Resources\Chat
 */
class Message extends Base
{
    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Chat\Message());
        $this->setResourceName('messages');
        parent::__construct($HttpClient);
    }
}
