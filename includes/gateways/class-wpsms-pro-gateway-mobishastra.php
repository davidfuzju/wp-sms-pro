<?php

namespace WP_SMS\Gateway;

class mobishastra extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://mshastra.com/";
    public $tariff = "https://mobishastra.com/";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->validateNumber = "e.g. +9715XX, 9715XX, 05XX, 5XX";
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
        $to = \implode(',', $this->to);
        $response = wp_remote_post($this->wsdl_link . "sendsms_api_json.aspx", ['body' => wp_json_encode([['user' => $this->username, 'pwd' => $this->password, 'number' => $to, 'msg' => $this->msg, 'sender' => $this->from, 'language' => 'English']])]);
        // Check gateway credit
        if (is_wp_error($response)) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $response->get_error_message(), 'error');
            return new \WP_Error('send-sms', $response->get_error_message());
        }
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code == '200') {
            $result = $response['body'];
            $json_result = \json_decode($result, \true);
            $json_result = \is_array($json_result) ? \reset($json_result) : [];
            if ($result == 'FAILURE' || empty($json_result) || empty($json_result['msg_id'])) {
                $error_message = !empty($json_result['str_response']) ? $json_result['str_response'] : $result;
                $this->log($this->from, $this->msg, $this->to, $error_message, 'error');
                return new \WP_Error('send-sms', $error_message);
            } else {
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
            }
        } else {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $response['body'], 'error');
            return new \WP_Error('send-sms', $response['body']);
        }
    }
    public function GetCredit()
    {
        // Check username and password
        if (!$this->username or !$this->password) {
            return new \WP_Error('account-credit', __('The username/password for this gateway is not set', 'wp-sms-pro'));
        }
        $response = wp_remote_get($this->wsdl_link . 'balance.aspx?user=' . $this->username . '&pwd=' . $this->password);
        if (is_wp_error($response)) {
            return new \WP_Error('account-credit', $response->get_error_message());
        }
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code == '200') {
            $result = $response['body'];
            return $result;
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
