<?php

namespace WP_SMS\Pro\Services\Controller;

use WPSmsPro\Vendor\League\Container\ServiceProvider\AbstractServiceProvider;
use WPSmsPro\Vendor\League\Container\ServiceProvider\BootableServiceProviderInterface;
class ControllerServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $provides = [];
    public function boot()
    {
        \WP_SMS\Pro\Services\Controller\SendSmsBlockAjaxManager::init();
    }
    public function register()
    {
    }
}
