<?php

namespace WPSmsPro\Vendor\MessageBird\Resources\Voice;

use WPSmsPro\Vendor\MessageBird\Common;
use WPSmsPro\Vendor\MessageBird\Objects;
/**
 * Class Webhooks
 *
 * @package MessageBird\Resources\Voice
 */
class Webhooks extends Base
{
    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Voice\Webhook());
        $this->setResourceName('webhooks');
        parent::__construct($HttpClient);
    }
}
