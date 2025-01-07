<?php

namespace WP_SMS\Gateway;

use Exception;
use WP_Error;
use WP_SMS\Gateway;
use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;
/**
 * AWS SNS Gateway Class
 *
 */
class awssns extends Gateway
{
    public $snsVersion = 'latest';
    private $client;
    public $unitrial = \false;
    public $unit;
    public $flash = "disable";
    public $isflash = \false;
    public $access_key;
    public $secret_key;
    public $region;
    public function __construct()
    {
        parent::__construct();
        $this->aws_sdk_autoload();
        $this->help = __('You can get your Access Key and Secret Key from the AWS Management Console.', 'wp-sms');
        $this->validateNumber = "The destination phone number. Format with a '+' and country code e.g., +16175551212 (E.164 format).";
        $this->bulk_send = \true;
        $this->supportMedia = \false;
        $this->supportIncoming = \false;
        $this->gatewayFields = ['access_key' => ['id' => 'access_key', 'name' => __('Access Key', 'wp-sms'), 'desc' => __('Enter your Access Key', 'wp-sms')], 'secret_key' => ['id' => 'secret_key', 'name' => __('Secret Key', 'wp-sms'), 'desc' => __('Enter your Secret Key', 'wp-sms')], 'region' => ['id' => 'region', 'name' => __('Region', 'wp-sms'), 'desc' => __('Enter your Region e.g. us-east-1', 'wp-sms')]];
    }
    public function SendSMS()
    {
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
            $credits = $this->GetCredit();
            if (is_wp_error($credits)) {
                throw new Exception($credits->get_error_message());
            }
            $this->client = new SnsClient(['version' => $this->snsVersion, 'region' => $this->region, 'credentials' => ['key' => $this->access_key, 'secret' => $this->secret_key]]);
            $response = $this->sendSnsMessage();
            /**
             * Run hook after send sms.
             *
             * @param string $response result output.
             *
             * @since 2.4
             *
             */
            do_action('wp_sms_send', $response);
            return $response;
        } catch (Exception $e) {
            return new WP_Error('send-sms', $e->getMessage());
        }
    }
    private function sendSnsMessage()
    {
        $result = [];
        $errors = [];
        foreach ($this->to as $number) {
            $args = ['Message' => $this->msg, 'PhoneNumber' => $number];
            try {
                $response = $this->client->publish($args);
                $result[$number]['to'] = $number;
                $result[$number]['status'] = $response;
                $this->log($this->from, $this->msg, $number, $response);
            } catch (AwsException $e) {
                $this->log($this->from, $this->msg, $number, $e->getMessage(), 'error');
                $errors[$number] = $e->getMessage();
            }
        }
        if ($errors) {
            throw new Exception('The SMS did not send for this number(s): ' . \implode('<br/>', \array_keys($errors)) . ' See the response on Outbox.');
        }
        return $result;
    }
    public function GetCredit()
    {
        try {
            if (empty($this->access_key) || empty($this->secret_key)) {
                return new WP_Error('account-credit', 'Please enter your AWS Access Key and Secret Key.');
            }
            return 'AWS SNS does not provide credit balance. Please check your AWS account for billing information.';
        } catch (Exception $e) {
            return new WP_Error('account-credit', $e->getMessage());
        }
    }
    public function aws_sdk_autoload()
    {
        try {
            $zipUrl = 'https://github.com/wp-sms/aws-vendor/archive/refs/heads/main.zip';
            $targetDir = WP_CONTENT_DIR . '/uploads/wp-sms-pro/';
            $autoloadFile = $targetDir . '/aws-vendor-main/vendor/autoload.php';
            if (\file_exists($autoloadFile)) {
                require_once $autoloadFile;
                return;
            }
            if (!\file_exists($autoloadFile)) {
                // create the target directory
                if (!\file_exists($targetDir)) {
                    \mkdir($targetDir, 0755, \true);
                }
                // download the zip file
                $zipFile = $targetDir . '/aws-vendor-main.zip';
                \file_put_contents($zipFile, \file_get_contents($zipUrl));
                // extract the zip file
                $zip = new \ZipArchive();
                if ($zip->open($zipFile) === \true) {
                    $zip->extractTo($targetDir);
                    $zip->close();
                }
                // delete the zip file
                \unlink($zipFile);
            }
        } catch (Exception $e) {
            \error_log($e->getMessage());
        }
    }
}
