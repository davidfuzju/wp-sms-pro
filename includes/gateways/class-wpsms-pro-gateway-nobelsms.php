<?php

namespace WP_SMS\Gateway;

class nobelsms extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://api.nobelsms.com/";
    public $tariff = "https://nobelsms.com/";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public $gatewayFields = ['username' => ['id' => 'gateway_username', 'name' => 'API username', 'desc' => 'Enter API username of gateway'], 'password' => ['id' => 'gateway_password', 'name' => 'API password', 'desc' => 'Enter API password of gateway'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender number', 'desc' => 'Sender number or sender ID'], 'has_key' => ['id' => 'gateway_key', 'name' => 'API token', 'desc' => 'Enter API token of gateway']];
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->bulk_send = \true;
        $this->validateNumber = "e.g. 9665xxxxxxxx";
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
        $country_code = isset($this->options['mobile_county_code']) ? $this->options['mobile_county_code'] : '';
        $recipients = [];
        foreach ($this->to as $to) {
            $recipients[] = $this->clean_number($to, $country_code);
        }
        $this->to = $recipients;
        foreach ($this->to as $to) {
            $response = wp_remote_post($this->wsdl_link . 'rest/send_sms', ['headers' => ['Content-Type: application/json', 'Accept: application/json'], 'timeout' => 30, 'body' => ['to' => $to, 'from' => $this->from, 'message' => $this->msg, 'username' => $this->username, 'password' => $this->password]]);
        }
        // Check gateway credit
        if (is_wp_error($response)) {
            // Log the result
            $this->log($this->from, $this->msg, $to, $response->get_error_message(), 'error');
            return new \WP_Error('send-sms', $response->get_error_message());
        }
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code == '200') {
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
        $response = wp_remote_get($this->wsdl_link . 'rest/account', ['headers' => ['Authorization' => "Bearer {$this->has_key}"]]);
        if (is_wp_error($response)) {
            return new \WP_Error('account-credit', $response->get_error_message());
        }
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code == '200') {
            $result = $response['body'];
            $result = \json_decode($result, \true);
            $result = \reset($result);
            return $result['balance'];
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
        //Remove 00 in the begining
        if (\substr($number, 0, 2) == "00") {
            $number = \substr($number, 2, \strlen($number));
        }
        //Remove 00 in the begining
        if (\substr($number, 0, 1) == "0") {
            $number = \substr($number, 1, \strlen($number));
        }
        $number = $country_code . $number;
        return $number;
    }
}
