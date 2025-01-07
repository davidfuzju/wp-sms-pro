<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class mehrafraz extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://mehrafraz.com/webservice/service.asmx?WSDL";
    public $tariff = "http://mehrafraz.com/fa";
    public $unitrial = \false;
    public $unit;
    public $flash = "false";
    public $isflash = \false;
    public $domain_name;
    public function __construct()
    {
        parent::__construct();
        $this->has_key = \false;
        $this->bulk_send = \true;
        $this->validateNumber = "";
        $this->help = "";
        $this->gatewayFields = ['username' => ['id' => 'gateway_username', 'name' => 'Username', 'desc' => 'Username'], 'password' => ['id' => 'gateway_password', 'name' => 'Password', 'desc' => 'Password'], 'domain_name' => ['id' => 'domain_name', 'name' => 'Domain Name', 'desc' => 'Domain Name'], 'from' => ['id' => 'gateway_sender_id', 'name' => 'Sender number', 'desc' => 'Please enter the sender number. Leave it empty to use the default sender number.']];
        @\ini_set("soap.wsdl_cache_enabled", "0");
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
            $client = new \SoapClient($this->wsdl_link);
            $result = $client->SendSms(array('cUserName' => $this->username, 'cPassword' => $this->password, 'cFromNumber' => $this->from, 'cSmsnumber' => \implode(',', $this->to), 'cBody' => $this->msg, 'cDomainname' => $this->domain_name, 'cGetid' => '1', 'nTypeSent' => 2, 'nCMessage' => 1, 'nSpeedsms' => 0, 'nPeriodmin' => 0));
            if (!isset($result->SendSmsResult)) {
                throw new Exception($result);
            }
            // Log the result
            $this->log($this->from, $this->msg, $this->to, $result);
            /**
             * Run hook after send sms.
             *
             * @param string $result result output.
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $result);
            return $result;
        } catch (\Exception $e) {
            $this->log($this->from, $this->msg, $this->to, $e->getMessage(), 'error');
            return new \WP_Error('send-sms', $e->getMessage());
        }
    }
    public function GetCredit()
    {
        try {
            // Check username and password
            if (!$this->username && !$this->password) {
                return new \WP_Error('account-credit', __('Username and Password are required.', 'wp-sms'));
            }
            if (!\class_exists('SoapClient')) {
                return new \WP_Error('required-class', __('Class SoapClient not found. please enable php_soap in your php.', 'wp-sms'));
            }
            $client = new \SoapClient($this->wsdl_link);
            $result = $client->GetuserInfo(array('cUserName' => $this->username, 'cPassword' => $this->password, 'cDomainName' => $this->domain_name));
            if ($result->GetuserInfoResult && $result->GetuserInfoResult->string == '-2') {
                throw new Exception('An error has occurred.');
            }
            return $result->GetuserInfoResult->string[1];
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
}
