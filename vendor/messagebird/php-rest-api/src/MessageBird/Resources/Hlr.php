<?php

namespace WPSmsPro\Vendor\MessageBird\Resources;

use WPSmsPro\Vendor\MessageBird\Objects;
use WPSmsPro\Vendor\MessageBird\Common;
/**
 * Class Hlr
 *
 * @package MessageBird\Resources
 */
class Hlr extends Base
{
    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Hlr());
        $this->setResourceName('hlr');
        parent::__construct($HttpClient);
    }
}
