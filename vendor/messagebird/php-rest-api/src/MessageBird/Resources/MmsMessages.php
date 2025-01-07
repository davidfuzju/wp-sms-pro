<?php

namespace WPSmsPro\Vendor\MessageBird\Resources;

use WPSmsPro\Vendor\MessageBird\Common;
use WPSmsPro\Vendor\MessageBird\Objects;
/**
 * Class MmsMessages
 *
 * @package MessageBird\Resources
 */
class MmsMessages extends Base
{
    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\MmsMessage());
        $this->setResourceName('mms');
        parent::__construct($HttpClient);
    }
}
