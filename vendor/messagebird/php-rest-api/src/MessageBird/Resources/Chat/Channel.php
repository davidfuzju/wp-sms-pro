<?php

namespace WPSmsPro\Vendor\MessageBird\Resources\Chat;

use WPSmsPro\Vendor\MessageBird\Objects;
use WPSmsPro\Vendor\MessageBird\Common;
use WPSmsPro\Vendor\MessageBird\Resources\Base;
/**
 * Class Channel
 *
 * @package MessageBird\Resources\Chat
 */
class Channel extends Base
{
    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Chat\Channel());
        $this->setResourceName('channels');
        parent::__construct($HttpClient);
    }
}
