<?php

namespace WP_SMS\Gateway;

class smscentral extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://my.smscentral.com.au/api/v3.2";
    public $tariff = "https://www.smscentral.com.au/";
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
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
        try {
            $response = $this->request('POST', $this->wsdl_link, [], ['body' => ['ACTION' => 'send', 'USERNAME' => $this->username, 'PASSWORD' => $this->password, 'ORIGINATOR' => $this->from, 'RECIPIENTMESSAGES' => \json_encode(\array_map(function ($item) {
                return ['RECIPIENT' => $item, 'MESSAGE_TEXT' => $this->msg, 'REFERENCE' => "NUMBER_{$item}"];
            }, $this->to))]]);
            if ($response != '0') {
                throw new \Exception($response);
            }
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $response);
            /**
             * Run hook after send sms.
             *
             * @param string $response result output.
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $response);
            return $response;
        } catch (\Exception $e) {
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new \WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        try {
            // Check API key and password
            if (!$this->username or !$this->password) {
                throw new \Exception(__('The API username or API password for this gateway is not set', 'wp-sms'));
            }
            $response = $this->request('POST', $this->wsdl_link, ['action' => 'balance', 'username' => $this->username, 'password' => $this->password]);
            $xml = \simplexml_load_string($response);
            if (isset($xml->errorcode)) {
                throw new \Exception($xml->errormessage);
            }
            return $xml->balance;
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            return new \WP_Error('account-credit', $error_message);
        }
    }
}
