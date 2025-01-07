<?php

namespace WPSmsPro\Vendor\MessageBird\Resources\Conversation;

use WPSmsPro\Vendor\MessageBird\Common\HttpClient;
use WPSmsPro\Vendor\MessageBird\Objects\Conversation\Content as ContentObject;
use WPSmsPro\Vendor\MessageBird\Resources\Base;
class Content extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        parent::__construct($httpClient);
        $this->setObject(new ContentObject());
    }
}
