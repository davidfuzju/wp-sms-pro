<?php

namespace WPSmsPro\Vendor\MessageBird\Resources\Chat;

use WPSmsPro\Vendor\MessageBird\Objects;
use WPSmsPro\Vendor\MessageBird\Common;
use WPSmsPro\Vendor\MessageBird\Resources\Base;
/**
 * Class Platform
 *
 * @package MessageBird\Resources\Chat
 */
class Platform extends Base
{
    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Chat\Platform());
        $this->setResourceName('platforms');
        parent::__construct($HttpClient);
    }
}
