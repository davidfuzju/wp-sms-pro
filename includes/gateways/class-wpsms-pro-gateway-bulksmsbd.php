<?php

namespace WP_SMS\Gateway;

class bulksmsbd extends \WP_SMS\Gateway
{
    private $wsdl_link = "http://wp.bulksmsbd.com/api";
    public $tariff = "http://wp.bulksmsbd.com";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public $gatewayFields = ['from' => ['id' => 'gateway_sender_id', 'name' => 'Sender number', 'desc' => 'Sender number or sender ID'], 'has_key' => ['id' => 'gateway_key', 'name' => 'API Key', 'desc' => 'Enter API Key, <a href="https://bulksmsbd.net/developers" target="_blank">Click here</a> to get it.']];
    public function __construct()
    {
        parent::__construct();
        $this->help = "অ্যাকাউন্ট করা না থাকলে  <a href='https://bulksmsbd.com' target='_blank'> এখানে  ক্লিক করুন </a>";
        $this->has_key = \true;
        $this->bulk_send = \true;
        $this->validateNumber = "e.g. 88017XXXXXXXX";
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
        $country_code = $this->options['mobile_county_code'] ?? '';
        $recipients = [];
        foreach ($this->to as $to) {
            $recipients[] = $this->clean_number($to, $country_code);
        }
        $this->to = $recipients;
        $response = wp_remote_post("{$this->wsdl_link}/smsapi", ['timeout' => 30, 'body' => ['api_key' => $this->has_key, 'senderid' => $this->from, 'type' => 'text', 'message' => $this->msg, 'number' => \implode(',', $this->to)]]);
        $response_code = wp_remote_retrieve_response_code($response);
        $response_body = wp_remote_retrieve_body($response);
        // Check gateway credit
        if (is_wp_error($response)) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $response->get_error_message(), 'error');
            return new \WP_Error('send-sms', $response->get_error_message());
        }
        if (\strpos($response_body, 'SMS Submitted Successfully')) {
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
        // Check username and password
        if (!$this->has_key) {
            return new \WP_Error('account-credit', __('The API Key for this gateway is not set', 'wp-sms-pro'));
        }
        $response = wp_remote_get($this->wsdl_link . "/getBalanceApi?api_key={$this->has_key}&senderid={$this->from}");
        if (is_wp_error($response)) {
            return new \WP_Error('account-credit', $response->get_error_message());
        }
        $response_code = wp_remote_retrieve_response_code($response);
        $json_array = \json_decode($response['body'], \true);
        $balance = $json_array['balance'];
        $error_Code = $json_array['response_code'];
        if ($response_code == '200' and $error_Code == '202') {
            return $balance;
        } else {
            return new \WP_Error('account-credit', $response['body']);
        }
    }
    private function clean_number($number, $country_code)
    {
        //Clean Country Code from + or 00
        $country_code = \str_replace('+', '', $country_code);
        if (\substr($country_code, 0, 2) == "00") {
            $country_code = \substr($country_code, 2, \strlen($country_code));
        }
        //Remove +
        $number = \str_replace('+', '', $number);
        if (\substr($number, 0, \strlen($country_code) * 2) == $country_code . $country_code) {
            $number = \substr($number, \strlen($country_code) * 2);
        } else {
            $number = \substr($number, \strlen($country_code));
        }
        //Remove 00 in the beginning
        if (\substr($number, 0, 2) == "00") {
            $number = \substr($number, 2, \strlen($number));
        }
        //Remove 00 in the beginning
        if (\substr($number, 0, 1) == "0") {
            $number = \substr($number, 1, \strlen($number));
        }
        $number = $country_code . $number;
        return $number;
    }
}
