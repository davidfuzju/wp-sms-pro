<?php

namespace WP_SMS\Pro\Services\RestApi;

use WP_SMS\Pro\Services\RestApi\Exceptions\SendRestResponse;
use WP_SMS\Pro\Exceptions\BadMethodCallException;
use WP_REST_Request;
use WP_REST_Response;
use WP_Error;
use JsonSerializable;
class Route implements JsonSerializable
{
    public const REST_NAMESPACE = 'wp-sms-pro/v1';
    /**
     * Route's address
     *
     * @var string
     */
    protected $route;
    /**
     * Request method
     *
     * @var string
     */
    protected $method;
    /**
     * Route's endpoint callback
     *
     * @var string
     */
    protected $endpoint;
    /**
     * Route's permission
     *
     * @see https://wordpress.org/support/article/roles-and-capabilities/
     * @var string
     */
    protected $permission;
    public function __construct()
    {
    }
    /**
     * Register a get route
     *
     * @param string $route
     * @param callable $endpoint
     * @param string|null $permission
     * @param string|null $nonceHandle
     * @return void
     */
    public static function get($route, $endpoint, $permission = null)
    {
        $instance = new self();
        $instance->method = 'GET';
        $instance->route = $route;
        $instance->endpoint = $endpoint;
        $instance->permission = $permission;
        $instance->register();
        return $instance;
    }
    /**
     * Register a post route
     *
     * @param string $route
     * @param callable $endpoint
     * @param string|null $permission
     * @param string|null $nonceHandle
     * @return void
     */
    public static function post($route, $endpoint, $permission = null)
    {
        $instance = new self();
        $instance->method = 'POST';
        $instance->route = $route;
        $instance->endpoint = $endpoint;
        $instance->permission = $permission;
        $instance->register();
        return $instance;
    }
    /**
     * Get route's url
     *
     * @param string|null $route
     * @return string
     */
    public function getUrl($route = null)
    {
        $route = $route ?? $this->route;
        $route = trailingslashit(self::REST_NAMESPACE) . $route;
        return get_rest_url(null, $route, 'rest');
    }
    /**
     * Register the route
     *
     * @return void
     */
    protected function register()
    {
        add_action('rest_api_init', function () {
            register_rest_route($this::REST_NAMESPACE, $this->route, ['methods' => $this->method, 'callback' => [$this, 'mainCallback'], 'permission_callback' => [$this, 'permissionCallback']]);
        });
    }
    /**
     * Check user permission
     *
     * @param WP_REST_Request $request
     * @return WP_Error|true
     */
    public function permissionCallback(WP_REST_Request $request)
    {
        if (wp_verify_nonce($request->get_header('X-WP-Nonce'), 'wp_rest') == \false) {
            return new WP_Error(403, 'Forbidden', ['status' => 403]);
        }
        if (isset($this->permission) && !current_user_can($this->permission)) {
            return new WP_Error(401, 'Not Authorized', ['status' => 401]);
        }
        return \true;
    }
    /**
     * Route's callback
     *
     * @param WP_REST_Request $request
     * @return void
     */
    public function mainCallback(WP_REST_Request $request)
    {
        try {
            return \call_user_func($this->endpoint, $request);
        } catch (SendRestResponse $exception) {
            return new WP_REST_Response($exception->getData(), $exception->getCode());
        } catch (\Throwable $error) {
            return new WP_Error(500, 'Internal Error.', ['message' => $error->getMessage()]);
        }
    }
    /**
     * Json-serialize the route object
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        if (!did_action('init')) {
            return new BadMethodCallException('Please serialize this object after the `init` hook.');
        }
        return ["method" => $this->method, "url" => $this->getUrl(), "nonce_header_key" => 'X-WP-Nonce', "nonce" => wp_create_nonce('wp_rest')];
    }
}
