<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class whatsappapi extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://server.whatsapp-api.net";
    public $tariff = "https://app.whatsapp-api.net/";
    public $unitrial = \true;
    public $unit;
    public $flash = "enable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->help = "<a href='https://app.whatsapp-api.net/register'>Create account</a>";
        $this->gatewayFields = ['from' => ['id' => 'gateway_device_id', 'name' => 'Device ID', 'desc' => 'Enter your sender ID'], 'has_key' => ['id' => 'gateway_jwt', 'name' => 'JWT', 'desc' => 'You can get your json web token by loging in the site . It must be like : eyJhbGciOiJIUz....']];
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
            $arguments = array('body' => \json_encode(array('jwt' => $this->has_key, 'devices' => $this->from, 'message' => $this->msg, 'numbers' => \implode(',', $this->to))));
            $response = $this->request('POST', "{$this->wsdl_link}/user/messages/send", [], $arguments);
            // error handler response
            if ($response->status !== 100) {
                throw new Exception($response->response);
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
            return __('JWT is require.', 'wp-sms-pro');
        }
        return 1;
    }
}
