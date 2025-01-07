<?php

namespace WPSmsPro\Vendor\League\Container\Exception;

use WPSmsPro\Vendor\Interop\Container\Exception\NotFoundException as NotFoundExceptionInterface;
use InvalidArgumentException;
class NotFoundException extends InvalidArgumentException implements NotFoundExceptionInterface
{
}
