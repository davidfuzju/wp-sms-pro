<?php

namespace WP_SMS\Pro\Services\Admin\LoginForm;

use WP_SMS\SmsOtp;
use WP_SMS\Option as WPSmsOptionsManager;
use WP_SMS\Helper;
use WP_SMS\Pro\Services\DynamicResponse\Response;
use WP_SMS\Pro\Services\DynamicResponse\Delegates as ResponseDelegates;
use WP_SMS\Pro\Services\RestApi\Route;
use WP_SMS\Pro\Services\RestApi\Exceptions\SendRestResponse;
use WP_SMS\Pro\Exceptions\InvalidPhoneNumberException;
use WP_SMS\Pro\Utils\Recaptcha\Recaptcha;
use WP_REST_Response;
use WP_REST_Request;
use WP_SMS\Components\NumberParser;
use WP_SMS\User\RegisterUserViaPhone;
use WP_SMS\User\UserLoginHandler;

/**
 * 验证码登录相关逻辑类
 */
class LoginWithSmsOtp
{
    /**
     * @var Route[]
     */
    private $endPoints = [];
    /**
     * @var Response
     */
    private $response;
    /**
     * @var Recaptcha
     */
    private $recaptcha;
    public function __construct()
    {
        $this->checkRequirements();
    }
    /**
     * Initialize login with sms functionality
     *
     * @return void
     */
    public static function init()
    {
        $instance = new self();
        $instance->setRecaptcha();
        $instance->registerEndpoints();
        $instance->enqueueScriptsAndStyles();
    }
    /**
     * Check requirements
     *
     * @return void
     */
    private function checkRequirements()
    {
        // TODO Display a one-time notice in wp-sms settings page about what just happened
        if (empty(WPSmsOptionsManager::getOption('add_mobile_field'))) {
            WPSmsOptionsManager::updateOption('add_mobile_field', 'add_mobile_field_in_profile');
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
            $this->enqueueLoginScript();
            isset($this->recaptcha) && $this->recaptcha->enqueueApiScript(['onload' => 'WPSmsProLoginFormLoadRecaptcha']);
        });
    }
    /**
     * Enqueue and localize login script
     *
     * @return void
     */
    private function enqueueLoginScript()
    {
        WPSmsPro()->enqueueScript('assets/dist/js/login-form/main.js', ['jquery']);
        $scriptHandle = WPSmsPro()->enqueueScript('assets/dist/js/login.js', ['jquery']);
        wp_localize_script($scriptHandle, 'WPSmsProLoginWithSmsData', ["l10n" => ['login_with_sms_title' => __('Login with SMS', 'wp-sms-pro'), 'login_with_sms_code_subtitle' => __('Please Enter Your Verification Code', 'wp-sms-pro'), 'login_with_sms_code_label' => __('Verification Code', 'wp-sms-pro'), 'login_with_sms_number_subtitle' => __('Please Enter Your Phone Number', 'wp-sms-pro'), 'or' => __('OR', 'wp-sms-pro'), 'login_button_text' => __('Login with SMS', 'wp-sms-pro'), 'login_with_email_text' => __('Login with Username/Email address', 'wp-sms-pro'), 'phone_number_field_label' => __('Phone Number', 'wp-sms-pro'), 'request_otp_button_text' => __('Continue', 'wp-sms-pro'), 'verify_button_text' => __('Verify', 'wp-sms-pro'), 'request_new_code_text' => __('Didn\'t Receive The Code?', 'wp-sms-pro'), 'request_new_code_link' => __('Request New Code', 'wp-sms-pro'), 'please_fill_digits_notice' => __('Please fill all the digit inputs', 'wp-sms-pro'), 'invalid_phone_number' => __('Invalid phone number!', 'wp-sms-pro')], "options" => ['intl_input_is_active' => WPSmsOptionsManager::getOption('international_mobile'), 'is_rtl_page' => is_rtl()], "elements" => ['mobile_field' => $this->renderMobileInputField()], "recaptcha" => ['site_key' => isset($this->recaptcha) ? $this->recaptcha->getSiteKey() : null], "endPoints" => $this->endPoints]);
        /// 加入 admin-ajax 的 url
        wp_localize_script($scriptHandle, 'ajaxurl', admin_url('admin-ajax.php'));
    }
    /**
     * Render mobile input field
     *
     * @return string html
     */
    private function renderMobileInputField()
    {
        \ob_start();
        wp_sms_render_mobile_field(['id' => 'phoneNumber']);
        return \ob_get_clean();
    }
    /**
     * Register REST endpoints
     *
     * @return void
     */
    private function registerEndpoints()
    {
        $this->endPoints = [
            'request_otp' => Route::post('login_form/request_otp', [$this, 'requestOtp']),
            'login_with_otp' => Route::post('login_form/login_with_otp', [$this, 'loginByOtp'])
        ];
    }
    /**
     * Request a new otp endpoint
     *
     * @param WP_REST_Request $request
     * @return void
     */
    public function requestOtp(WP_REST_Request $request)
    {
        try {
            if (isset($this->recaptcha) && !$this->recaptcha->verifyUserResponse((string) $request->get_param('recaptcha_response'))) {
                throw new SendRestResponse(['message' => __('Recaptcha failed.')], 403);
            }
            $inputPhoneNumber = sanitize_text_field($request->get_param('phone_number'));
            $user = Helper::getUserByPhoneNumber($inputPhoneNumber);
            $isNewUser = \false;
            if (\class_exists(NumberParser::class)) {
                $numberParser = new NumberParser($inputPhoneNumber);
                $inputPhoneNumber = $numberParser->getValidNumber();
                if (is_wp_error($inputPhoneNumber)) {
                    throw new InvalidPhoneNumberException();
                }
            }
            if (empty($user)) {
                // If user with this number not found and register_sms option is enabled, then register user with phone
                if (WPSmsOptionsManager::getOption('register_sms', \true)) {
                    $isNewUser = \true;
                } else {
                    // Otherwise send error response
                    throw new SendRestResponse(['message' => __('No user is registered with the given phone number.', 'wp-sms-pro')], 400);
                }
            }
            $otp = (new SmsOtp\SmsOtp($inputPhoneNumber, 'wp-sms-login-with-sms'))->generate();
            $messageText = WPSmsOptionsManager::getOption('login_sms_message', \true);
            (new Response($otp->getPhoneNumber(), \false, '/\\%(.*?)\\%/'))->addVariablesFromDelegate(ResponseDelegates\LoginWithSmsDelegate::class, ['otp' => $otp])->send($messageText);
            throw new SendRestResponse(['message' => __('Passcode is successfully sent to your number.', 'wp-sms-pro'), 'is_new' => $isNewUser], 200);
        } catch (InvalidPhoneNumberException $error) {
            throw new SendRestResponse(['message' => __('Please enter a valid phone number.', 'wp-sms-pro')], 400);
        } catch (SmsOtp\Exceptions\OtpLimitExceededException $error) {
            throw new SendRestResponse(['message' => $error->getMessage()], 429);
        }
    }
    /**
     * Login with SMS OTP
     *
     * @param WP_REST_Request $request
     * @return void
     */
    public function loginByOtp(WP_REST_Request $request)
    {
        try {
            $inputPhoneNumber = (string) sanitize_text_field($request->get_param('phone_number'));
            $inputCode = (string) $request->get_param('code');
            $referralCode = (string) $request->get_param('referral_code');
            $isNewUser = \filter_var($request->get_param('is_new'), \FILTER_VALIDATE_BOOLEAN);
            if (\class_exists(NumberParser::class)) {
                $numberParser = new NumberParser($inputPhoneNumber);
                $inputPhoneNumber = $numberParser->getValidNumber();
                if (is_wp_error($inputPhoneNumber)) {
                    throw new InvalidPhoneNumberException();
                }
            }
            $success = (new SmsOtp\SmsOtp($inputPhoneNumber, 'wp-sms-login-with-sms'))->verify($inputCode);
            if ($success !== \true) {
                throw new SendRestResponse(['message' => __('Wrong passcode.', 'wp-sms-pro')], 401);
            }
            $user = Helper::getUserByPhoneNumber($inputPhoneNumber);
            if (empty($user)) {
                $userId = null;
                if (!empty($inputCode) && WPSmsOptionsManager::getOption('register_sms', \true)) {
                    $registerUser = new RegisterUserViaPhone($inputPhoneNumber);
                    $userId = $registerUser->register();
                    if (is_wp_error($userId)) {
                        throw new SendRestResponse(['message' => $userId->get_error_message()], 500);
                    }
                    $user = Helper::getUserByPhoneNumber($inputPhoneNumber);
                }
                if (\is_null($userId)) {
                    throw new SendRestResponse(['message' => __('No user is registered with the given phone number.', 'wp-sms-pro')], 400);
                }
            }

            if (function_exists('nv_referral_code_handle_new_registration')) {
                nv_referral_code_handle_new_registration($user->ID, $referralCode);
            }

            if (\class_exists(UserLoginHandler::class)) {
                $userLoginHandler = new UserLoginHandler($user);
                $userLoginHandler->login();
                $redirectUrl = $userLoginHandler->getRedirectUrl($user, user_admin_url(), $request, $isNewUser);
            } else {
                // @todo Remove in the next version
                wp_clear_auth_cookie();
                wp_set_current_user($user->ID);
                wp_set_auth_cookie($user->ID, \false, is_ssl());
                do_action('wp_login', $user->user_login, $user);
                $redirectUrl = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : user_admin_url();
                if ($isNewUser) {
                    // User has registered just now
                    $redirectUrl = apply_filters('registration_redirect', $redirectUrl, null);
                } else {
                    // User was registered before and is logging in again
                    $redirectUrl = apply_filters('login_redirect', $redirectUrl, $redirectUrl, $user);
                }
                $redirectUrl = wp_validate_redirect(wp_sanitize_redirect(wp_unslash($redirectUrl)));
            }
            throw new SendRestResponse(['message' => __('You have been successfully logged in', 'wp-sms-pro'), 'redirect_to' => $redirectUrl], 200);
        } catch (InvalidPhoneNumberException $error) {
            throw new SendRestResponse(['message' => __('Please enter a valid phone number.', 'wp-sms-pro')], 400);
        } catch (SmsOtp\Exceptions\TooManyAttemptsException $error) {
            throw new SendRestResponse(['message' => $error->getMessage()], 429);
        }
    }
}
