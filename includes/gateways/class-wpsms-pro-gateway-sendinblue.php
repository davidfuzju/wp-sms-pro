<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class sendinblue extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://api.sendinblue.com/v3";
    public $tariff = "https://www.sendinblue.com/";
    public $unitrial = \true;
    public $unit;
    public $flash = "enable";
    public $isflash = \false;
    /**
     * sendinblue constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \true;
        $this->validateNumber = "33689965433";
        $this->help = "Reading this document will help you take your api key :  <a href='https://help.sendinblue.com/hc/en-us/articles/209467485-Create-or-delete-an-API-key' > API KEY</a>";
        $this->gatewayFields = ['has_key' => ['id' => 'gateway_key', 'name' => 'API Key', 'desc' => 'Enter your authorization key.'], 'from' => ['id' => 'API Key', 'name' => 'Sender ID', 'desc' => 'Sender number or sender ID']];
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
            $arguments = array('headers' => array('accept' => 'application/json', 'api-key' => $this->has_key, 'content-type' => 'application/json'), 'body' => \json_encode(array('sender' => $this->from, 'recipient' => \implode(',', $this->to), 'content' => $this->msg)));
            $response = $this->request('POST', "{$this->wsdl_link}/transactionalSMS/sms", [], $arguments);
            if (isset($response->status) && $response->status !== \true) {
                throw new Exception($response);
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
        // Check api
        try {
            if (!$this->has_key) {
                throw new Exception(__('Api key is require!', 'wp-sms-pro'));
            }
            $arguments = ['headers' => ['accept' => 'application/json', 'api-key' => $this->has_key]];
            $response = $this->request('GET', "{$this->wsdl_link}/account", [], $arguments);
            if (isset($response->plan[1]->type)) {
                $free = $response->plan[0]->credits;
                $sms = $response->plan[1]->credits;
                return $free;
            }
            return $response;
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}
