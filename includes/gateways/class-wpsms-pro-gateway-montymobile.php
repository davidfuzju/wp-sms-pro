<?php

namespace WP_SMS\Gateway;

class montymobile extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://httpsmsc02.montymobile.com/HTTP/api/Client/SendSMS";
    public $tariff = "https://montymobile.com";
    public $unitrial = \false;
    public $unit;
    public $flash = "disabled";
    public $isflash = \false;
    public $bulk_send = \true;
    public $access_token = '';
    public $api_id = '';
    public function __construct()
    {
        parent::__construct();
        $this->gatewayFields = ['username' => ['id' => 'gateway_username', 'name' => 'Username', 'desc' => 'Enter your username.'], 'password' => ['id' => 'gateway_password', 'name' => 'Password', 'desc' => 'Enter your password.'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender ID', 'desc' => '']];
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
            $country_code = isset($this->options['mobile_county_code']) ? $this->options['mobile_county_code'] : '';
            // Clean all numbers
            $mobileNumbers = \array_map(function ($item) use($country_code) {
                return $this->clean_number($item, $country_code);
            }, $this->to);
            // Convert the array to a comma-separated string
            $mobileNumbers = \implode(',', $mobileNumbers);
            $response = wp_remote_post($this->wsdl_link, ['headers' => ['Content-Type' => 'application/json', 'Username' => $this->username, 'Password' => $this->password], 'timeout' => 30, 'body' => wp_json_encode(['destination' => $mobileNumbers, 'source' => $this->from, 'text' => $this->msg, 'dataCoding' => 8])]);
            // Check response error
            if (is_wp_error($response)) {
                $this->log($this->from, $this->msg, $this->to, $response->get_error_message(), 'error');
                throw new \Exception($response->get_error_message());
            }
            $response_code = wp_remote_retrieve_response_code($response);
            $body = wp_remote_retrieve_body($response);
            if (empty($body) or $response_code != '200') {
                $this->log($this->from, $this->msg, $this->to, $body, 'error');
                throw new \Exception('Unknown Error');
            }
            if ($body !== 'MESSAGE_FAILED') {
                // Log the result
                $result = \sprintf(__('%s, sent successfully.', 'wp-sms-pro'), $this->msg);
                $this->log($this->from, $this->msg, $this->to, $result);
                /**
                 * Run hook after send sms.
                 *
                 * @since 2.4
                 */
                do_action('wp_sms_send', $result);
                return $result;
            } else {
                $result = \sprintf(__('%s, failed.', 'wp-sms-pro'), $this->msg);
                $this->log($this->from, $this->msg, $this->to, $result, 'error');
                throw new \Exception($result);
            }
        } catch (\Exception $e) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new \WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        $response = wp_remote_get('https://sms.montymobile.com/API/AccountBalance', ['body' => ['username' => $this->username, 'password' => $this->password]]);
        $body = wp_remote_retrieve_body($response);
        return $body;
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
