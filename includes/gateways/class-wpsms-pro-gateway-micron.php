<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class micron extends \WP_SMS\Gateway
{
    private $wsdl_link = "http://entsms.microntechbd.com:8080/bulksms/bulksms";
    public $tariff = "http://entsms.microntechbd.com";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->help = "<a href='http://client.microntechbd.com/clientsgn/docs/Micron-SMSPlus-HTTP-API-Specifications-D10.pdf' target='_blank'> API Documentation </a>";
        $this->has_key = \false;
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
        $recipients = [];
        foreach ($this->to as $to) {
            $recipients[] = $this->clean_number($to, $country_code);
        }
        try {
            $country_code = $this->options['mobile_county_code'] ?? '';
            $username = $this->username;
            $password = $this->password;
            $to = \implode($recipients, ",");
            $to = \urlencode($to);
            $text = \urlencode($this->msg);
            $from = \urlencode($this->from);
            $arguments = ['username' => $username, 'password' => $password, 'type' => '0', 'dlr' => '0', 'destination' => $to, 'source' => $from, 'message' => $text];
            $response = $this->request('GET', "{$this->wsdl_link}", $arguments, []);
            // If response does not contain 1701 code, then there is an arror
            if (isset($response) && \strpos($response, '1701') !== 0) {
                throw new Exception($this->getErrorMessage($response));
            }
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $this->msg);
            /**
             * Run hook after send sms.
             *
             * @param string $result result output.
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $response);
            return $this->msg;
        } catch (Exception $e) {
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        // Check username and password
        if (!$this->username || !$this->password) {
            return new WP_Error('account-credit', __('Username or password for this gateway are not set', 'wp-sms-pro'));
        }
        return 1;
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
    private function getErrorMessage($response)
    {
        switch ($response) {
            case 1702:
                return 'Invalid URL. This means that one of the parameters was not provided or left blank.';
            case 1703:
                return 'Invalid value in username or password field.';
            case 1704:
                return 'Invalid value in type field.';
            case 1705:
                return 'Invalid message.';
            case 1706:
                return 'Invalid destination.';
            case 1707:
                return 'Invalid source (Sender).';
            case 1709:
                return 'User validation failed.';
            case 1710:
                return 'Internal error.';
            case 1725:
                return 'Insufficient credit.';
            default:
                return 'Unknown Error!';
        }
    }
}
