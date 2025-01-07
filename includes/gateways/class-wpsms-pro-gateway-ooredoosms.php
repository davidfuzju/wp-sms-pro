<?php

namespace WP_SMS\Gateway;

class ooredoosms extends \WP_SMS\Gateway
{
    private $wsdl_link = "http://doo.ae/api/";
    public $tariff = "";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \false;
        $this->bulk_send = \true;
        $this->validateNumber = "e.g. 971555555555";
    }
    public function SendSMS()
    {
        /**
         * Modify sender number
         *
         * @param string $this ->from sender number.
         * @since 3.4
         *
         */
        $this->from = apply_filters('wp_sms_from', $this->from);
        /**
         * Modify Receiver number
         *
         * @param array $this ->to receiver number
         * @since 3.4
         *
         */
        $this->to = apply_filters('wp_sms_to', $this->to);
        /**
         * Modify text message
         *
         * @param string $this ->msg text message.
         * @since 3.4
         *
         */
        $this->msg = apply_filters('wp_sms_msg', $this->msg);
        // Get the credit.
        $credit = $this->GetCredit();
        // Check gateway credit
        if (is_wp_error($credit)) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $credit->get_error_message(), 'error');
            return $credit;
        }
        $to = \implode(',', $this->to);
        $to = \urlencode($to);
        $text = $this->convertToUnicode($this->msg);
        $this->from = \urlencode($this->from);
        $response = wp_remote_get($this->wsdl_link . "msgSend.php?mobile=" . $this->username . "&password=" . $this->password . "&sender=" . $this->from . "&msg=" . $text . "&numbers=" . $to . "&timeSend=0&dateSend=0&applicationType=3");
        // Check gateway credit
        if (is_wp_error($response)) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $response->get_error_message(), 'error');
            return new \WP_Error('send-sms', $response->get_error_message());
        }
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response['body'] == '1' && $response_code == '200') {
            $result = $response['body'];
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $result);
            /**
             * Run hook after send sms.
             *
             * @param string $result result output.
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $result);
            return $result;
        } else {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, 'Error: ' . $response['body'], 'error');
            return new \WP_Error('send-sms', 'Error: ' . $response['body']);
        }
    }
    public function GetCredit()
    {
        // Check api key
        if (!$this->username or !$this->password) {
            return new \WP_Error('account-credit', __('The username/password for this gateway is not set', 'wp-sms'));
        }
        $response = wp_remote_get($this->wsdl_link . "balance.php?mobile={$this->username}&password={$this->password}");
        // Check gateway credit
        if (is_wp_error($response)) {
            return new \WP_Error('account-credit', $response->get_error_message());
        }
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code == '200') {
            if (\strpos($response['body'], '/') !== \false) {
                return $response['body'];
            } else {
                return new \WP_Error('account-credit', 'Error: ' . $response['body']);
            }
        } else {
            return new \WP_Error('account-credit', $response['body']);
        }
    }
}
