<?php

namespace WP_SMS\Gateway;

class smsbroadcast extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://api.smsbroadcast.com.au/api-adv.php";
    public $tariff = "https://smsbroadcast.com.au";
    public $unitrial = \false;
    public $unit;
    public $flash = "disabled";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \false;
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
        // Get the credit.
        $credit = $this->GetCredit();
        // Check gateway credit
        if (is_wp_error($credit)) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $credit->get_error_message(), 'error');
            return $credit;
        }
        try {
            $username = $this->username;
            $password = $this->password;
            $country_code = isset($this->options['mobile_county_code']) ? $this->options['mobile_county_code'] : '';
            // Clean all numbers
            $mobileNumbers = \array_map(function ($item) use($country_code) {
                return $this->clean_number($item, $country_code);
            }, $this->to);
            $mobileNumbers = \implode(",", $mobileNumbers);
            $response = wp_remote_post($this->wsdl_link, ['body' => ['username' => \rawurlencode($this->username), 'password' => \rawurlencode($this->password), 'to' => \rawurlencode($mobileNumbers), 'from' => \rawurlencode($this->from), 'message' => \urldecode($this->msg)]]);
            $response_code = wp_remote_retrieve_response_code($response);
            // Check response error
            if (is_wp_error($response)) {
                // Log the result
                $this->log($this->from, $this->msg, $this->to, $response->get_error_message(), 'error');
                // Return error
                return new \WP_Error('send-sms', $response->get_error_message());
            }
            $body = wp_remote_retrieve_body($response);
            if (empty($body)) {
                // Log th result
                $this->log($this->from, $this->msg, $this->to, $body, 'error');
                return \false;
            }
            $responseLines = \explode("\n", $body);
            $responseLines = \array_filter(\reset($responseLines));
            list($resultStatus, $resultError, $resultMessage) = \explode(":", $responseLines);
            if (\is_array($responseLines) && !empty($resultStatus)) {
                if ($resultStatus == 'OK') {
                    // Log the result
                    $this->log($this->from, $this->msg, $this->to, $body);
                    /**
                     * Run hook after send sms.
                     *
                     * @since 2.4
                     */
                    do_action('wp_sms_send', $body);
                    // return result
                    return $body;
                } elseif ($resultStatus == 'BAD') {
                    // Log the result
                    $this->log($this->from, $this->msg, $this->to, $resultMessage, 'error');
                    // Return error
                    return new \WP_Error('send-sms', $resultMessage);
                } elseif ($resultStatus == 'ERROR') {
                    // Log the result
                    $this->log($this->from, $this->msg, $this->to, $resultError, 'error');
                    // Return error
                    return new \WP_Error('send-sms', $resultError);
                }
            }
        } catch (\Exception $e) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new \WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        $response = wp_remote_post($this->wsdl_link, ['body' => ['username' => \rawurlencode($this->username), 'password' => \rawurlencode($this->password), 'action' => 'balance']]);
        $response_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        list($resultStatus, $resultMessage) = \explode(":", $body);
        if (!empty($body) && !empty($resultStatus)) {
            if ($resultStatus == 'OK') {
                // return credit
                return $resultMessage;
            } elseif ($resultStatus == 'ERROR') {
                // return error
                return new \WP_Error('account-credit', $resultMessage);
            }
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
