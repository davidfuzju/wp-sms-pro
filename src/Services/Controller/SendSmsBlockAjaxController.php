<?php

namespace WP_SMS\Pro\Services\Controller;

use WP_SMS\Notification\NotificationFactory;
use WP_SMS\Controller\AjaxControllerAbstract;
class SendSmsBlockAjaxController extends AjaxControllerAbstract
{
    protected $action = 'wp_sms_send_front_sms';
    protected $options;
    protected $sender;
    protected $recipients;
    protected $message;
    protected $group_ids;
    protected $numbers;
    protected $recipientNumbers;
    public $requiredFields = ['recipients', 'message'];
    protected function run()
    {
        $this->sender = $this->get('sender');
        $this->recipients = $this->get('recipients');
        $this->message = $this->get('message');
        $this->group_ids = $this->get('group_ids');
        $this->numbers = $this->get('numbers');
        // Check max character count
        $this->checkSmsCharactersCount($this->message, (int) $this->get('maxCount'));
        // Get recipient numbers from request
        $this->recipientNumbers = $this->getRecipientNumbers();
        // Send front end SMS
        $this->sendSms();
    }
    private function checkSmsCharactersCount($string, $max)
    {
        if (\strlen($string) > $max) {
            wp_send_json_error(['message' => __('The text you have entered exceeds the maximum character count.', 'wp-sms-pro')], 400);
        }
    }
    private function getRecipientNumbers()
    {
        $recipients = array();
        switch ($this->recipients) {
            case 'subscribers':
                if ($this->group_ids == '') {
                    wp_send_json_error(['message' => __('Parameter group_ids is required', 'wp-sms-pro')], 400);
                }
                $recipients = \WP_SMS\Newsletter::getSubscribers([$this->group_ids], \true);
                break;
            case 'numbers':
                if (!$this->numbers) {
                    wp_send_json_error(['message' => __('Parameter numbers is required', 'wp-sms-pro')], 400);
                }
                $recipients = [$this->numbers];
                break;
            case 'admin':
                $adminOption = wp_sms_get_option('admin_mobile_number');
                if (!$adminOption) {
                    wp_send_json_error(['message' => __('Admin mobile number not found', 'wp-sms-pro')], 400);
                }
                $recipients = array($adminOption);
                break;
        }
        return $recipients;
    }
    /*
     * Process Privacy Form
     */
    private function sendSms()
    {
        $notification = NotificationFactory::getHandler();
        $response = $notification->send($this->message, $this->recipientNumbers, [], \false, $this->sender);
        if (is_wp_error($response)) {
            wp_send_json_error(['message' => $response->get_error_message()], 400);
        }
        wp_send_json_success(__('Successfully send SMS!', 'wp-sms-pro'));
    }
}
