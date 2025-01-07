<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class every8d extends \WP_SMS\Gateway
{
    private $wsdl_link;
    public $tariff = "https://www.teamplus.tech";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public $gateway_domain_name;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \false;
        $this->bulk_send = \true;
        $this->validateNumber = "";
        $this->help = "";
        $this->gatewayFields = ['username' => ['id' => 'gateway_username', 'name' => 'Account', 'desc' => 'Enter your account username.'], 'password' => ['id' => 'gateway_password', 'name' => 'API Secret', 'desc' => 'Enter your password.'], 'gateway_domain_name' => ['id' => 'gateway_domain_name', 'name' => 'Site URL', 'desc' => 'Enter the site URL.']];
    }
    public function SendSMS()
    {
        /**
         * Modify sender number
         *
         * @param string $this ->from sender number.
         *
         * @since 3.4
         *
         */
        $this->from = apply_filters('wp_sms_from', $this->from);
        /**
         * Modify Receiver number
         *
         * @param array $this ->to receiver number
         *
         * @since 3.4
         *
         */
        $this->to = apply_filters('wp_sms_to', $this->to);
        /**
         * Modify text message
         *
         * @param string $this ->msg text message.
         *
         * @since 3.4
         *
         */
        $this->msg = apply_filters('wp_sms_msg', $this->msg);
        try {
            $apiUrl = ": https://{$this->gateway_domain_name}/API21/HTTP/SendSMS.ashx";
            $token = $this->getToken();
            $arguments = ['headers' => ['Authorization' => "Bearer {$token}", 'Content-Type' => 'application/x-www-form-urlencoded'], 'body' => ['UID' => $this->username, 'PWD' => $this->password, 'MSG' => $this->msg, 'DEST' => \implode(',', $this->to)]];
            $response = $this->request('POST', $apiUrl, [], $arguments);
            if (isset($response) && \substr($response, 0, 3) === '-99') {
                throw new Exception($response['Msg']);
            }
            // Log the result
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
            // Check username and password
            if (!$this->username || !$this->password || !$this->gateway_domain_name) {
                return new WP_Error('account-credit', __('The username, password and site URL are required.', 'wp-sms-pro'));
            }
            $apiUrl = " https://{$this->gateway_domain_name}/API21/HTTP/GetCredit.ashx";
            $token = $this->getToken();
            $arguments = ['headers' => ['Authorization' => "Bearer {$token}", 'Content-Type' => 'application/x-www-form-urlencoded'], 'body' => ['UID' => $this->username, 'PWD' => $this->password]];
            $response = $this->request('POST', $apiUrl, [], $arguments);
            if (isset($response) && \substr($response, 0, 3) === '-99') {
                throw new Exception($response['Msg']);
            }
            return $response['Credit'];
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
    private function getToken()
    {
        if (empty(get_transient('wp_sms_every8d_token'))) {
            $apiUrl = " https://{$this->gateway_domain_name}/API21/HTTP/ConnectionHandler.ashx";
            $params = ['HandlerType' => 3, 'VerifyType' => 1, 'UID' => $this->username, 'PWD' => $this->password];
            $response = $this->request('POST', $apiUrl, $params, []);
            if (isset($response) && $response['Result'] === 'false') {
                throw new Exception($response['Msg']);
            }
            $token = $response['Msg'];
            set_transient('wp_sms_every8d_token', $token, DAY_IN_SECONDS);
        } else {
            $token = get_transient('wp_sms_every8d_token');
        }
        return $token;
    }
}
