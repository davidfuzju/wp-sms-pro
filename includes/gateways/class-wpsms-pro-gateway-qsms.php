<?php

namespace WP_SMS\Gateway;

class qsms extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://www.qsms.com.au/websms/";
    public $tariff = "https://www.qsms.com.au";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \false;
        $this->bulk_send = \true;
        $this->validateNumber = "e.g. 44798xxxxxxx, 4478xxxxxxxx, 6591xxxxx";
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
        $type = 0;
        $text = $this->msg;
        // Check unicode option if enabled.
        if (isset($this->options['send_unicode']) and $this->options['send_unicode']) {
            $type = 2;
            $text = $this->convertToUnicode($this->msg);
        }
        $to = \implode(',', $this->to);
        $to = \urlencode($to);
        $this->from = \urlencode($this->from);
        $response = wp_remote_get($this->wsdl_link . "sendsms.aspx?User=" . $this->username . "&passwd=" . $this->password . "&mobilenumber=" . $to . "&message=" . $text . "&senderid=" . $this->from . "&type=" . $type);
        // Check gateway credit
        if (is_wp_error($response)) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $response->get_error_message(), 'error');
            return new \WP_Error('send-sms', $response->get_error_message());
        }
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code == '200' and \strpos($response['body'], '1701') !== \false) {
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
            $this->log($this->from, $this->msg, $this->to, $response['body'], 'error');
            return new \WP_Error('send-sms', $response['body']);
        }
    }
    public function GetCredit()
    {
        // Check api key
        if (!$this->username or !$this->password) {
            return new \WP_Error('account-credit', __('The username/password for this gateway is not set', 'wp-sms'));
        }
        return 1;
    }
}
