<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
use WP_SMS\Helper;
class mysms extends Gateway
{
    private $wsdl_link = "https://api.mysms.com/json";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public $gateway_key;
    public $gateway_password;
    public $gateway_msisdn;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \false;
        $this->supportMedia = \false;
        $this->supportIncoming = \false;
        $this->help = 'Contact mySMS support to get the API.';
        $this->validateNumber = "International format without + (plus sign), followed by a country code, network code and the subscriber number. e.g. 88017XXXXXXXX";
        $this->gatewayFields = ['gateway_key' => ['id' => 'gateway_key', 'name' => __('API Key', 'wp-sms'), 'desc' => __('Enter your API KEY', 'wp-sms')], 'gateway_password' => ['id' => 'gateway_password', 'name' => __('APP Password', 'wp-sms'), 'desc' => __('Enter your APP Password', 'wp-sms')], 'gateway_msisdn' => ['id' => 'gateway_msisdn', 'name' => __('Sender number', 'wp-sms'), 'desc' => __('Enter your Sender number (msisdn)', 'wp-sms')]];
    }
    public function SendSMS()
    {
        /**
         * Modify sender number
         *
         * @param string $this - >from sender number.
         *
         * @since 3.4
         *
         */
        $this->from = apply_filters('wp_sms_from', $this->from);
        /**
         * Modify Receiver number
         *
         * @param array $this - >to receiver number
         *
         * @since 3.4
         *
         */
        $this->to = apply_filters('wp_sms_to', $this->to);
        /**
         * Modify text message
         *
         * @param string $this - >msg text message.
         *
         * @since 3.4
         *
         */
        $this->msg = apply_filters('wp_sms_msg', $this->msg);
        try {
            $credits = $this->GetCredit();
            if (is_wp_error($credits)) {
                throw new Exception($credits->get_error_message());
            }
            $this->to = Helper::removeNumbersPrefix(['+'], $this->to);
            $from = \str_replace('+', '', $this->gateway_msisdn);
            $arguments = ['api_key' => $this->gateway_key, 'msisdn' => $from, 'password' => $this->gateway_password, 'recipient' => $this->to[0], 'message' => $this->msg];
            $response = $this->request('GET', $this->wsdl_link . '/message/send', $arguments, [], \false);
            if ($response->errorCode != 0) {
                throw new Exception($this->getErrorMessage($response->errorCode));
            }
            $this->log($this->from, $this->msg, $this->to, $response);
            /**
             * Run hook after send sms.
             *
             * @param string $result result output.
             *
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $response);
            return $response;
        } catch (Exception $e) {
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        try {
            if (empty($this->gateway_key) || empty($this->gateway_password) || empty($this->gateway_msisdn)) {
                return new WP_Error('account-credit', 'Please complete the gateway settings.');
            }
            return 'mySMS does not provide credit balance.';
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
    /**
     * Returns the error message corresponding to the given error code.
     *
     * @param int $errorCode The error code to look up.
     * @return string The corresponding error message.
     */
    public function getErrorMessage($errorCode)
    {
        $errorMessages = [2 => "A required parameter was not given", 97 => "The access to the api was denied", 98 => "You made too much requests in a short time", 99 => "The service is currently not available", 100 => "The auth token is invalid", 101 => "The credentials are wrong", 109 => "The login is blocked for a specific time, because some wrong logins were made", 113 => "For this operation the user must have a msisdn associated", 200 => "One or more recipients are not in the correct format or are containing invalid msisdns (i.e: 436761234567)", 202 => "The credit is not enough to send the message to all recipients", 600 => "The api key is invalid", 1000 => "The api key is invalid"];
        return isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : "Unknown error code";
    }
}
