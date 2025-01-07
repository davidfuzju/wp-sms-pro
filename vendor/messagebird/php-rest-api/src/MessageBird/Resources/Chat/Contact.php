<?php

namespace WPSmsPro\Vendor\MessageBird\Resources\Chat;

use WPSmsPro\Vendor\MessageBird\Objects;
use WPSmsPro\Vendor\MessageBird\Common;
use WPSmsPro\Vendor\MessageBird\Resources\Base;
/**
 * Class Contact
 *
 * @package MessageBird\Resources\Chat
 */
class Contact extends Base
{
    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Chat\Contact());
        $this->setResourceName('contacts');
        parent::__construct($HttpClient);
    }
}
