<?php

namespace WP_SMS\Gateway;

class msg360 extends \WP_SMS\Gateway
{
    private $wsdl_link = "http://trans.msg360.in/";
    public $tariff = "http://trans.msg360.in/";
    public $unitrial = \false;
    public $unit;
    public $flash = "enable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->validateNumber = "Check phone number";
        $this->help = "Help";
        $this->bulk_send = \true;
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
        $msg = \urlencode($this->msg);
        $result = \file_get_contents($this->wsdl_link . "websms/sendsms.aspx?userid=" . $this->username . "&password=" . $this->password . "&sender=" . $this->from . "&mobileno=" . $to . "&msg=" . $msg);
        if (\preg_match("/^Success/s", $result)) {
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
            $this->log($this->from, $this->msg, $this->to, $result, 'error');
            return new \WP_Error('send-sms', $result);
        }
    }
    public function GetCredit()
    {
        // Check username and password
        if (!$this->username or !$this->password) {
            return new \WP_Error('account-credit', __('The username/password for this gateway is not set', 'wp-sms-pro'));
        }
        return \true;
    }
}
