<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
/**
 * Class smspapa
 *
 * Website: https://www.smspapa.com.au
 * API Doc: https://www.smspapa.com.au/developer-sms-api
 *
 * @package WP_SMS\Gateway
 */
class smspapa extends Gateway
{
    private $wsdl_link = "https://www.smspapa.com.au/api/sms.asmx/";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->bulk_send = \true;
        $this->supportMedia = \false;
        $this->supportIncoming = \false;
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
            $balance = $this->GetCredit();
            if (is_wp_error($balance)) {
                throw new Exception($balance->get_error_message());
            }
            $arguments = ['username' => $this->username, 'password' => $this->password, 'messageText' => $this->msg];
            if (!empty($this->from)) {
                $arguments['senderName'] = $this->from;
            }
            // Conversion for bulk sending
            if (\count($this->to) > 1) {
                foreach ($this->to as $number) {
                    $arguments["mobileNumber[{$number}]"] = $number;
                }
            } else {
                $arguments['mobileNumber'] = $this->to[0];
            }
            $response = $this->request('GET', $this->wsdl_link . 'SendMessage', $arguments);
            $response = (array) \simplexml_load_string($response);
            // check error!!!
            if (\strpos($response[0], 'ERR:') === 0) {
                throw new Exception($response[0]);
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
            $arguments = ['username' => $this->username, 'password' => $this->password];
            $response = $this->request('POST', $this->wsdl_link . 'GetCreditBalance', $arguments);
            $response = (array) \simplexml_load_string($response);
            // check error!!!
            if (\strpos($response[0], 'ERR:') === 0) {
                throw new Exception($response[0]);
            }
            return $response[0];
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}
