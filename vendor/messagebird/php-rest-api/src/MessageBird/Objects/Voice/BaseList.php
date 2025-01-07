<?php

namespace WPSmsPro\Vendor\MessageBird\Objects\Voice;

use WPSmsPro\Vendor\MessageBird\Objects\Base;
/**
 * Class BaseList
 *
 * @package MessageBird\Objects\Voice
 */
class BaseList extends Base
{
    public $totalCount;
    public $pageCount;
    public $currentPage;
    public $perPage;
    public $items = array();
}
