<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class rapidsms extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://si.rapidsms.net/RestApi/SMSAPI.svc";
    public $tariff = "https://www.rapidsms.net";
    public $unitrial = \true;
    public $unit;
    public $flash = "enable";
    public $isflash = \false;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->help = "You can create your username and password <a href='https://login.rapidsms.net/'>here</a>";
        $this->gatewayFields = ['username' => ['id' => 'gateway_username', 'name' => 'Username', 'desc' => 'Enter API username of gateway'], 'password' => ['id' => 'gateway_password', 'name' => 'Password', 'desc' => 'Enter API password of gateway']];
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
            $arguments = array('userName' => $this->username, 'password' => $this->password, 'toMobile' => \implode(',', $this->to), 'smsText' => $this->msg);
            $response = $this->request('GET', "{$this->wsdl_link}/SMS/SendSMS", $arguments, []);
            //response error handler
            if ($response->result === FALSE) {
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
        if (!$this->username || !$this->password) {
            return __('Username/Password are require.', 'wp-sms-pro');
        }
        return 1;
    }
}
