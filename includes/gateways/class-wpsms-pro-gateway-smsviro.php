<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class smsviro extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://api.smsviro.com";
    public $tariff = "https://www.smsviro.com/";
    public $unitrial = \true;
    public $unit;
    public $flash = "enable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->help = "You can create your username and password <a href='https://smsviro.com/daftar'>here</a>";
        $this->gatewayFields = ['from' => ['id' => 'gateway_sender_id', 'name' => 'Sender number', 'desc' => 'Sender number or sender ID'], 'has_key' => ['id' => 'gateway_key', 'name' => 'API key', 'desc' => 'Enter API key of gateway']];
    }
    public function SendSMS()
    {
        /**
         * Modify sender id
         */
        $this->from = apply_filters('wp_sms_from', $this->from);
        /**
         * Modify Receiver number
         */
        $this->to = apply_filters('wp_sms_to', $this->to);
        /**
         * Modify text message
         */
        $this->msg = apply_filters('wp_sms_msg', $this->msg);
        try {
            $arguments = array('headers' => array('apikey' => $this->has_key, 'accept' => 'application/json', 'content-type' => 'application/json'), 'body' => \json_encode(array('from' => $this->from, 'destination' => \implode(',', $this->to), 'message' => $this->msg)));
            $response = $this->request('POST', "{$this->wsdl_link}/restapi/sms/1/text/advanced", [], $arguments);
            //response error handler
            if ($response != 200) {
                throw new Exception($this->getErrorMessage($response->response));
            }
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $response);
            /*
             * Run hook after send sms.
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
        if (!$this->has_key) {
            return __('Api key is require.', 'wp-sms-pro');
        }
        return 1;
    }
}
