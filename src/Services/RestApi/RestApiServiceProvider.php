<?php

// phpcs:ignore WordPress.Files.FileName
namespace WP_SMS\Pro\Services\RestApi;

use WPSmsPro\Vendor\League\Container\ServiceProvider\AbstractServiceProvider;
use WPSmsPro\Vendor\League\Container\ServiceProvider\BootableServiceProviderInterface;
/**
 * Registers the REST API wrapper into the plugin
 */
class RestApiServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /**
     * The provided array is a way to let the container
     * know that a service is provided by this service
     * provider. Every service that is registered via
     * this service provider must have an alias added
     * to this array or it will be ignored.
     *
     * @var array
     */
    protected $provides = [];
    /**
     * @return void
     */
    public function boot()
    {
    }
    /**
     * Register the route service into the plugin
     *
     * @return void
     */
    public function register()
    {
    }
}
