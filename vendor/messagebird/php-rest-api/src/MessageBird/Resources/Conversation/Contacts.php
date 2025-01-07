<?php

namespace WPSmsPro\Vendor\MessageBird\Resources\Conversation;

use WPSmsPro\Vendor\MessageBird\Common\HttpClient;
use WPSmsPro\Vendor\MessageBird\Objects\Conversation\Contact;
use WPSmsPro\Vendor\MessageBird\Resources\Base;
class Contacts extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        parent::__construct($httpClient);
        $this->setObject(new Contact());
    }
}
