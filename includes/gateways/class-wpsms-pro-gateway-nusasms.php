<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
class nusasms extends \WP_SMS\Gateway
{
    private $wsdl_link = "https://api.nusasms.com/api";
    public $tariff = "https://nusasms.com/";
    public $unitrial = \true;
    public $unit;
    public $flash = "enable";
    public $isflash = \false;
    public $from = '';
    public function __construct()
    {
        parent::__construct();
        $this->validateNumber = '62XXXXXXXXXXX';
        $this->has_key = \false;
        $this->help = "You can create your username and password <a href='https://app.nusasms.com/'>here</a>";
        $this->gatewayFields = ['username' => ['id' => 'gateway_username', 'name' => 'Username', 'desc' => 'Enter your username'], 'password' => ['id' => 'gateway_password', 'name' => 'Password', 'desc' => 'Enter  password of gateway']];
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
            $arguments = array('body' => \json_encode(array('user' => $this->username, 'password' => $this->password, 'smstext' => $this->msg, 'GSM' => \implode(',', $this->to))));
            $response = $this->request('POST', "{$this->wsdl_link}/v3/sendsms/plain", $arguments, []);
            //response error handler
            if (!isset($response) || $response->results[0]->status !== 0) {
                throw new Exception($this->getErrorMessaage($response->results[0]->status));
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
        try {
            // Check username and password
            if (!$this->username && !$this->password) {
                throw new Exception(__('Username/password for this gateway are required.', 'wp-sms-pro'));
            }
            $arguments = ['user' => $this->username, 'password' => $this->password, 'cmd' => 'CREDITS', 'type' => 'sms', 'output' => 'json'];
            $response = $this->request('GET', "{$this->wsdl_link}/command", $arguments, []);
            if ($response->results[0]->status !== 0) {
                throw new Exception($this->getErrorMessaage($response->results[0]->status));
            }
        } catch (\Throwable $e) {
            return new \WP_Error('get-credit', $e->getMessage());
        }
    }
    private function getErrorMessaage($code)
    {
        switch ($code) {
            case '-1':
                return 'Error in processing the request';
            case '-2':
                return 'Not enough credits on a specific account';
            case '-3':
                return 'Targeted network is not covered on specific account';
            case '-5':
                return 'Username or password is invalid';
            case '-6':
                return 'Destination address is missing in the request';
            case '-7':
                return 'Balance has expired';
            case '-9':
                return 'Routing not found for specific operator';
            case '-10':
                return 'OTP messages that do not use an OTP route will be REJECTED';
            case '-11':
                return 'Number is not recognized by NusaSMS platform';
            case '-12':
                return 'Message is missing in the request';
            case '-13':
                return 'Number is not recognized by NusaSMS platform';
            case '-22':
                return 'Incorrect XML format, caused by syntax error';
            case '-23':
                return 'General error, reasons may vary';
            case '-26':
                return 'General API error, reasons may vary';
            case '-27':
                return 'Invalid scheduling parametar';
            case '-28':
                return 'Invalid PushURL in the request';
            case '-30':
                return 'Invalid APPID in the request';
            case '-33':
                return 'Duplicated MessageID in the request';
            case '-34':
                return 'Sender name is not allowed';
            case '-40':
                return 'Client IP Address Not In White List';
            case '-77':
                return 'More than 10 same message send to the same recipeints in 1 day';
            case '-78':
                return 'Sending messages to the same number has reached the limit in 24 hours';
            case '-88':
                return 'Operator Rejected The Request';
            case '-99':
                return 'Error in processing request, reasons may vary';
        }
        return $code;
    }
}
