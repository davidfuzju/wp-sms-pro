<?php

namespace WPSmsPro\Vendor\MessageBird\Resources;

use WPSmsPro\Vendor\MessageBird\Objects;
use WPSmsPro\Vendor\MessageBird\Common;
/**
 * Class Balance
 *
 * @package MessageBird\Resources
 */
class Balance extends Base
{
    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Balance());
        $this->setResourceName('balance');
        parent::__construct($HttpClient);
    }
}
