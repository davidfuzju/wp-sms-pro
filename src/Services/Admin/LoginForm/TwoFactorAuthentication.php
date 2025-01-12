<?php

namespace WP_SMS\Pro\Services\Admin\LoginForm;

use WP_SMS\Option as MainPluginOptionManager;
use WP_SMS\Helper as MainPluginHelper;
use WP_SMS\Option as WPSmsOptionsManager;
use WP_SMS\SmsOtp;
use WP_SMS\Pro\Services\DynamicResponse\Response;
use WP_SMS\Pro\Services\DynamicResponse\Delegates as ResponseDelegates;
use WP_SMS\Pro\Services\RestApi\Route;
use WP_SMS\Pro\Services\RestApi\Exceptions\SendRestResponse;
use WP_SMS\Pro\Exceptions\InvalidPhoneNumberException;
use WP_SMS\Pro\Utils\Recaptcha\Recaptcha;
use WP_REST_Request;
use WP_Error;
use WP_User;

class TwoFactorAuthentication
{
    private $endPoints = [];
    /**
     * @var Response
     */
    private $response;
    private function __construct()
    {
        $this->checkRequirements();
    }
    /**
     * Init 2FA in the default login-form
     *
     * @return void
     */
    public static function init()
    {
        $instance = new self();
        $instance->registerEndpoints();
        $instance->enqueueScriptsAndStyles();
        $instance->addTwoFactorAuthGuardToLoginForm();
        if (MainPluginOptionManager::getOption('mobile_verify_method', \true) == 'optional') {
            $instance->addTwoFactorOptionToUsers();
        }
    }
    /**
     * Check requirements
     *
     * @return void
     */
    private function checkRequirements()
    {
        // TODO Display a one-time notice in wp-sms settings page about what just happened
        if (empty(MainPluginOptionManager::getOption('add_mobile_field'))) {
            MainPluginOptionManager::updateOption('add_mobile_field', 'add_mobile_field_in_profile');
        }
    }
    /**
     * Set recaptcha
     *
     * @return void
     */
    private function setRecaptcha()
    {
        $this->recaptcha = Recaptcha::makeFromWPSmsSettings();
    }
    /**
     * Enqueue scripts and styles
     *
     * @return void
     */
    private function enqueueScriptsAndStyles()
    {
        add_action('login_enqueue_scripts', function () {
            WPSmsPro()->enqueueStyle('assets/dist/css/login.css');
            $this->enqueueMainScript();
            isset($this->recaptcha) && $this->recaptcha->enqueueApiScript();
        });
    }
    /**
     * Enqueue and localize login script
     *
     * @return void
     */
    private function enqueueMainScript()
    {
        WPSmsPro()->enqueueScript('assets/dist/js/login-form/main.js', ['jquery']);
        $scriptHandle = WPSmsPro()->enqueueScript('assets/dist/js/login.js');
        wp_localize_script($scriptHandle, 'WPSmsLoginFormTwoFactorAuthData', ["l10n" => ['two_factor_auth_title' => __('Two Factor Authentication', 'wp-sms-pro'), 'two_factor_auth_subtitle' => __('Please Enter Your Verification Code', 'wp-sms-pro'), 'verification_code_label' => __('Verification Code', 'wp-sms-pro'), 'submit_button_text' => __('Submit', 'wp-sms-pro'), 'please_fill_digits_notice' => __('Please fill all the digit inputs', 'wp-sms-pro'), 'request_new_code_text' => __('Didn\'t Receive The Code?', 'wp-sms-pro'), 'request_new_code_link' => __('Request New Code', 'wp-sms-pro')], "recaptcha" => ['site_key' => isset($this->recaptcha) ? $this->recaptcha->getSiteKey() : null], "endPoints" => $this->endPoints, "options" => ['intl_input_is_active' => WPSmsOptionsManager::getOption('international_mobile'), 'is_rtl_page' => is_rtl()]]);
    }
    /**
     * Register endpoints
     *
     * @return void
     */
    private function registerEndpoints()
    {
        $this->endPoints = ['request_code' => Route::post('login_form/request_two_factor_auth_code', [$this, 'requestTwoFactorAuthCode'])];
    }
    /**
     * Request a new-otp endpoint
     *
     * @param WP_REST_Request $request
     * @return void
     */
    public function requestTwoFactorAuthCode(WP_REST_Request $request)
    {
        try {
            if (isset($this->recaptcha) && !$this->recaptcha->verifyUserResponse($request->get_param('recaptcha_response'))) {
                throw new SendRestResponse(['message' => __('Recaptcha failed.', 'wp-sms-pro')], 403);
            }
            $userLogin = $request->get_param('user_login');
            $userPass = $request->get_param('user_pass');
            $user = wp_authenticate_username_password(null, $userLogin, $userPass);
            if (is_wp_error($user)) {
                /// MARK: 修改 invalid_username 的文案
                $error_code = $user->get_error_code();
                if ('invalid_username' === $error_code) {
                    $user->remove('invalid_username');
                    $user->add(
                        'invalid_username',
                        sprintf(
                            /* translators: %s: User name. */
                            __('<strong>Error:</strong> The username <strong>%s</strong> is not registered on this site. If you are unsure of your username, try your mobile with SMS instead.'),
                            $userLogin
                        )
                    );
                }
                throw new SendRestResponse($user->get_error_messages(), 400);
            }
            $phoneNumber = MainPluginHelper::getUserMobileNumberByUserId($user->ID);
            if (!self::userNeedsTwoFactorAuthentication($user->ID)) {
                throw new SendRestResponse(['userNeedsVerification' => \false, 'message' => __('User does not need two-factor authentication.', 'wp-sms-pro')], 200);
            }
            $otp = (new SmsOtp\SmsOtp($phoneNumber, 'wp-sms-login-form-two-factor-auth'))->generate();
            $messageText = MainPluginOptionManager::getOption('mobile_verify_message', \true);
            (new Response($otp->getPhoneNumber(), \false, '/\\%(.*?)\\%/'))->addVariablesFromDelegate(ResponseDelegates\TwoFactorAuthenticationDelegate::class, ['otp' => $otp])->send($messageText);
            throw new SendRestResponse(['userNeedsVerification' => \true, 'message' => __('Passcode is successfully generated.', 'wp-sms-pro')], 201);
        } catch (InvalidPhoneNumberException $error) {
            throw new SendRestResponse(['message' => __('User\'s phone number is not valid.', 'wp-sms-pro')], 400);
        } catch (SmsOtp\Exceptions\OtpLimitExceededException $error) {
            throw new SendRestResponse(['message' => $error->getMessage()], 429);
        }
    }
    /**
     * Add two factor option to each user profile
     *
     * @return void
     */
    private static function addTwoFactorOptionToUsers()
    {
        add_filter('wp_sms_user_profile_fields', function ($fields, $userId) {
            $fields['optional_2fa'] = ['id' => 'wp_sms_otp', 'title' => __('Two factor authentication'), 'content' => MainPluginHelper::loadTemplate('admin/otp-optional-field.php', ['value' => get_user_meta($userId, 'wp_sms_otp', \true)], \true)];
            return $fields;
        }, 11, 2);
        $saveCallback = function ($userId) {
            $value = isset($_POST['wp_sms_otp']) ? 1 : 0;
            update_user_meta($userId, 'wp_sms_otp', $value);
        };
        add_action('personal_options_update', $saveCallback, 10, 1);
        add_action('edit_user_profile_update', $saveCallback, 10, 1);
    }
    /**
     * Add two-factor authentication guard to login form
     *
     * @return void
     */
    private function addTwoFactorAuthGuardToLoginForm()
    {
        /**  INFO: Behavior: Default value may be an instance of
         *         `WP_User` or `WP_Error`, changing the value
         *          to an instance of `WP_Error`, will intercept
         *          the default login behavior
         */
        add_filter(
            'authenticate',
            /**
             * @param WP_User|WP_Error $userOrError
             * @param string $userName
             * @param string $password
             */
            function ($userOrError, $userName, $password) {
                $user = get_user_by('login', $userName);
                if (!$user instanceof WP_User || !self::userNeedsTwoFactorAuthentication($user->ID)) {
                    return $userOrError;
                }
                $phoneNumber = MainPluginHelper::getUserMobileNumberByUserId($user->ID);
                $inputCode = isset($_REQUEST['wpsms_two_factor_auth_code']) ? $_REQUEST['wpsms_two_factor_auth_code'] : '';
                $OtpIsVerified = (new SmsOtp\SmsOtp($phoneNumber, 'wp-sms-login-form-two-factor-auth'))->verify($inputCode);
                if ($OtpIsVerified) {
                    return $userOrError;
                }
                if (is_wp_error($userOrError)) {
                    $userOrError->add('authentication_failed', __('<strong>Error</strong>: Invalid code, 2FA failed.', 'wp-sms-pro'));
                    return $userOrError;
                }
                return new WP_Error('authentication_failed', __('<strong>Error</strong>: Invalid code, 2FA failed.', 'wp-sms-pro'));
            },
            100,
            3
        );
    }
    /**
     * Check whether a user needs two factor authentication
     *
     * @param integer $userId
     * @return void
     */
    private static function userNeedsTwoFactorAuthentication($userId)
    {
        $twoFactorAuthIsOptional = MainPluginOptionManager::getOption('mobile_verify_method', \true) == 'optional';
        $userPhoneNumber = MainPluginHelper::getUserMobileNumberByUserId($userId);
        $userDoesNotWantTwoFactor = !(bool) get_user_meta($userId, 'wp_sms_otp', \true);
        if (empty($userPhoneNumber)) {
            return \false;
        }
        if ($twoFactorAuthIsOptional && $userDoesNotWantTwoFactor) {
            return \false;
        }
        return \true;
    }
}
