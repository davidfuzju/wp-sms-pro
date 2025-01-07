<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class mitake extends \WP_SMS\Gateway
{
    private $wsdl_link;
    public $tariff = "https://www.mitake.com.tw";
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
        $this->gatewayFields = ['username' => ['id' => 'gateway_username', 'name' => 'Username', 'desc' => 'Enter your username.'], 'password' => ['id' => 'gateway_password', 'name' => 'Password', 'desc' => 'Enter your password.'], 'gateway_domain_name' => ['id' => 'gateway_domain_name', 'name' => 'Sān zhú Domain Name', 'desc' => 'Enter the domain name.']];
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
            $apiUrl = "{$this->gateway_domain_name}/b2c/mtk/SmSend?CharsetURL=UTF-8";
            foreach ($this->to as $recipient) {
                $body = ['username' => $this->username, 'password' => $this->password, 'dstaddr' => $recipient, 'smbody' => $this->msg];
                $arguments = ['headers' => ['Content-type' => 'application/x-www-form-urlencoded'], 'body' => $body];
                $response = $this->request('POST', $apiUrl, [], $arguments);
                //todo
                //            if (isset($response->code) and in_array($response->code, [4901, 1901]) === false) {
                //                throw new Exception($this->getErrorMessageByCode($response->code));
                //            }
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
            }
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
            if (!$this->username or !$this->password) {
                return new WP_Error('account-credit', __('The username/password for this gateway is not set', 'wp-sms-pro'));
            }
            return 1;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}
