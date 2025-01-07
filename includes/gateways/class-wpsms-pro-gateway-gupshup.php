<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
class gupshup extends Gateway
{
    private $wsdl_link = " http://enterprise.smsgupshup.com/GatewayAPI/rest";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public $userid;
    public $password;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->supportMedia = \false;
        $this->supportIncoming = \false;
        $this->validateNumber = 'Mobile Number With Country Code';
        $this->gatewayFields = ['userid' => ['id' => 'userid', 'name' => __('UserId', 'wp-sms'), 'desc' => __('Enter your Gupshup UserId', 'wp-sms')], 'password' => ['id' => 'password', 'name' => __('Password', 'wp-sms'), 'desc' => __('Enter your Gupshup Password', 'wp-sms')]];
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
            $recipients = \str_replace(' ', '', \implode(',', $this->to));
            $arguments = ['userid' => $this->userid, 'password' => $this->password, 'send_to' => $recipients, 'msg' => $this->msg, 'method' => 'sendMessage', 'msg_type' => 'text', 'format' => 'json', 'auth_scheme' => 'plain', 'v' => '1.1'];
            $response = $this->request('GET', $this->wsdl_link, $arguments);
            if (isset($response->error)) {
                throw new Exception($response->error);
            }
            if ($response->response->status == 'error') {
                throw new Exception($response->response->details);
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
            if (empty($this->userid) || empty($this->password)) {
                return new WP_Error('account-credit', 'Please enter your Gupshup UserId and Password');
            }
            return 'Unable to check balance!';
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}
