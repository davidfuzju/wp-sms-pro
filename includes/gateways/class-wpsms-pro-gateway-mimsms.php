<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
class mimsms extends Gateway
{
    private $wsdl_link = "https://api.mimsms.com/";
    public $tariff = "https://www.mimsms.com/";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->bulk_send = \true;
        $this->help = "The message will be sent only to a valid phone number (numbers), written in international format e.g.8801844909020. We strongly recommend using the international format without + (plus sign), followed by a country code, network code and the subscriber number. Phone numbers that are not recommend formatted may not work properly.";
        $this->validateNumber = "International format without + (plus sign), followed by a country code, network code and the subscriber number. e.g. 88017XXXXXXXX";
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
        try {
            $credits = $this->GetCredit();
            if (is_wp_error($credits)) {
                throw new Exception($credits->get_error_message());
            }
            $this->to = \str_replace('+', '', $this->to);
            $params = ['UserName' => $this->username, 'Apikey' => $this->has_key, 'MobileNumber' => \implode(',', $this->to), 'SenderName' => $this->from, 'TransactionType' => 'T', 'Message' => $this->msg];
            $messageType = 'Send';
            if (\count($this->to) > 1) {
                $messageType = 'SendOneToMany';
            }
            $response = $this->request('GET', $this->wsdl_link . 'api/SmsSending/' . $messageType, $params, [], \false);
            if ($response->statusCode != 200) {
                throw new Exception($response->responseResult);
            }
            $this->log($this->from, $this->msg, $this->to, $response);
            /**
             * Run hook after send sms.
             *
             * @param string $result result output.
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
            if (empty($this->username) || empty($this->password) || empty($this->has_key)) {
                return new WP_Error('account-credit', __('The Username, Password, or API Key for this gateway is not set', 'wp-sms-pro'));
            }
            $params = ['userName' => $this->username, 'Apikey' => $this->has_key];
            $response = $this->request('GET', $this->wsdl_link . 'api/SmsSending/balanceCheck', $params, [], \false);
            if ($response->statusCode != 200) {
                throw new Exception($response->responseResult);
            }
            return $response->responseResult;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}
