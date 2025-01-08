<?php

/**
 * Plugin Name: WP SMS Pro Pack
 * Plugin URI: https://wp-sms-pro.com/
 * Description: The professional pack adds many features, supports the most popular SMS gateways, and also integrates with other plugins.
 * Version: 4.3.6.6
 * Author: VeronaLabs
 * Author URI: https://veronalabs.com/
 * Text Domain: wp-sms-pro
 * Domain Path: /languages
 * Requires Plugins:  wp-sms
 */

namespace WPSmsPlugin;

if (\file_exists(\dirname(__FILE__) . '/vendor/autoload.php')) {
    require \dirname(__FILE__) . '/vendor/autoload.php';
}
// Set the plugin version
\define('WP_SMS_PRO_VERSION', '4.3.6.6');
/*
 * Load Legacy functionalities
 */
require_once \dirname(__FILE__) . '/includes/bootstrap.php';

use WP_SMS\Pro\BasePluginAbstract;
use WP_SMS\Pro\Traits\SingletonTrait;
use WP_SMS\Pro\Services as InternalServices;
use WP_SMS\Pro\Exceptions\RequirementsNotMetException;

// 添加逻辑需要配套使用的类
use WP_SMS\Helper;
use WP_SMS\Components\NumberParser;

class WPSmsPro extends BasePluginAbstract
{
    use SingletonTrait;
    private $pluginServiceProviders = [InternalServices\Admin\AdminServiceProvider::class, InternalServices\RepeatingMessages\RepeatingMessagesServiceProvider::class, InternalServices\Integration\IntegrationServiceProvider::class, InternalServices\Controller\ControllerServiceProvider::class];
    /**
     * Init the plugin
     *
     * @return void
     */
    public function init()
    {
        try {
            $this->checkPluginDependencies();
            $this->loadPluginServiceProviders();
        } catch (RequirementsNotMetException $error) {
            //TODO - skipping, appropriate actions have been taken in the legacy part.
            \error_log($error->getMessage());
        } catch (\Throwable $error) {
            \error_log($error->getMessage());
        }
    }
    /**
     * Check plugin dependencies
     *
     * @return void
     */
    private function checkPluginDependencies()
    {
        //Check if WP SMS is active
        if (!is_plugin_active('wp-sms/wp-sms.php')) {
            throw new RequirementsNotMetException();
        }
    }
    /**
     * Load plugin's service providers
     *
     * @return void
     */
    private function loadPluginServiceProviders()
    {
        foreach ($this->pluginServiceProviders as $provider) {
            $this->addServiceProvider(new $provider());
        }
    }
}
WPSmsPro()->init();

// ----------------------------------------------
// 后端接口逻辑
// ----------------------------------------------

/// 暂时将 referral code 查询代码放在此处
add_action('wp_ajax_check_referral_code_by_phone', 'nv_check_referral_code_by_phone');
add_action('wp_ajax_nopriv_check_referral_code_by_phone', 'nv_check_referral_code_by_phone');

function nv_check_referral_code_by_phone()
{
    if (! isset($_POST['phone_number'])) {
        wp_send_json_error(
            array('message' => 'Missing phone_number in POST data.',),
            400
        );
    }

    $inputPhoneNumber = (string) sanitize_text_field($_POST['phone_number']);

    if (\class_exists(NumberParser::class)) {
        $numberParser = new NumberParser($inputPhoneNumber);
        $inputPhoneNumber = $numberParser->getValidNumber();
        if (is_wp_error($inputPhoneNumber)) {
            wp_send_json_error(
                array('message' => 'Invalid phone number'),
                400
            );
        }
    }

    $user = Helper::getUserByPhoneNumber($inputPhoneNumber);

    if (empty($user)) {
        wp_send_json_success(
            array(
                'is_registered' => false,
                'has_referral_code' => false,
                'message' => 'No user found with this phone number.'
            )
        );
    } else {
        $referral_code = get_user_meta($user->ID, 'wrc_ref_code', true);

        if (empty($referral_code)) {
            wp_send_json_success(
                array(
                    'is_registered' => true,
                    'has_referral_code' => false,
                    'message' => 'User found but no referral code.',
                )
            );
        } else {
            wp_send_json_success(
                array(
                    'is_registered' => true,
                    'has_referral_code' => true,
                    'message' => 'User found, referral code exists.',
                )
            );
        }
    }
}

add_action('wp_ajax_validate_referral_code', 'nv_validate_referral_code');
add_action('wp_ajax_nopriv_validate_referral_code', 'nv_validate_referral_code');

function nv_validate_referral_code()
{
    // 1) 读取并过滤请求参数
    $phone_number = isset($_POST['phone_number']) ? sanitize_text_field($_POST['phone_number']) : '';
    $referral_code = isset($_POST['referral_code']) ? sanitize_text_field($_POST['referral_code']) : '';

    // 2) （可选）检查必填项
    if (empty($referral_code)) {
        wp_send_json_error(
            array('message' => 'Missing referral_code in POST data.'),
            400
        );
    }

    // 3) 查询是否存在这样的 referral code
    //   这里假设 referral code 存储在 user_meta 的 `wrc_ref_code` 键上
    $users = get_users(array(
        'meta_key'   => 'wrc_ref_code',
        'meta_value' => $referral_code,
        'number'     => 1,            // 只要一个匹配结果
        'fields'     => 'ID',         // 只需要用户 ID 即可
    ));

    if (empty($users)) {
        // 找不到任何用户使用了这个 referral code
        wp_send_json_success(
            array(
                'result' => false,
                'message' => 'Referral code is invalid.',
            )
        );
    }

    // 如果代码走到这里，说明至少有一个用户在 user_meta 里存着 `wrc_ref_code = $referral_code`
    // 你可以再做更多业务检查，比如：
    //   - 是否这个 referral code 已经失效或过期？
    //   - 是否这个 referral code 对应的用户与 phone_number 有关联？
    //   根据你的需求来写

    // 如果只是简单说明“referral code 存在”，则返回成功
    wp_send_json_success(
        array(
            'result' => true,
            'message' => 'Referral code is valid.',
        )
    );
}
