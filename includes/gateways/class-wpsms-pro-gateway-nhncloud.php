<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class nhncloud extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://api-sms.cloud.toast.com";
    public $tariff = "https://www.nhncloud.com/kr";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \false;
        $this->bulk_send = \true;
        $this->validateNumber = "";
        $this->help = "";
        $this->gatewayFields = ['username' => ['id' => 'gateway_username', 'name' => 'App Key', 'desc' => 'Enter your app key.'], 'password' => ['id' => 'gateway_password', 'name' => 'Secret Key', 'desc' => 'Original secret key.'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender Number', 'desc' => 'Enter your sender number.']];
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
            $appKey = \trim($this->username);
            $apiUrl = "{$this->wsdl_link}/sms/v3.0/appKeys/{$appKey}/sender/sms";
            $recipientList = [];
            foreach ($this->to as $recipient) {
                $temp['recipientNo'] = $recipient;
                $recipientList[] = $temp;
            }
            $arguments = ['headers' => ['Content-Type' => 'application/json', 'X-Secret-Key' => $this->password], 'body' => \json_encode(['body' => $this->msg, 'sendNo' => \trim($this->from), 'recipientList' => $recipientList])];
            $response = $this->request('POST', $apiUrl, [], $arguments);
            if (isset($response->header->isSuccessful) && !$response->header->isSuccessful) {
                throw new Exception($response->header->resultMessage);
            }
            // Log the result
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
            // Check username and password
            if (!$this->username || !$this->password) {
                return new WP_Error('account-credit', __('The username and password are required.', 'wp-sms-pro'));
            }
            return 1;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}
