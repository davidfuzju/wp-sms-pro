<?php

namespace WPSmsPro\Vendor\MessageBird\Resources\Conversation;

use WPSmsPro\Vendor\MessageBird\Common\HttpClient;
use WPSmsPro\Vendor\MessageBird\Objects\Conversation\Webhook;
use WPSmsPro\Vendor\MessageBird\Resources\Base;
class Webhooks extends Base
{
    const RESOURCE_NAME = 'webhooks';
    public function __construct(HttpClient $httpClient)
    {
        parent::__construct($httpClient);
        $this->setObject(new Webhook());
        $this->setResourceName(self::RESOURCE_NAME);
    }
}
