<?php

namespace WP_SMS\Pro;

if (!\defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
if (!\class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}
class Scheduled
{
    public $db;
    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        if (!wp_next_scheduled('wpsms_send_schedule_sms', array())) {
            add_action('init', array($this, 'schedule_wpsms_cron'));
        }
        add_filter('cron_schedules', array($this, 'check_cron'));
        add_action('wpsms_send_schedule_sms', array($this, 'send_sms_scheduled'));
    }
    public static function get($schedule_id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'sms_scheduled';
        $schedule_id = \intval($schedule_id);
        return $wpdb->get_row("SELECT * FROM {$table_name} WHERE id='{$schedule_id}'", ARRAY_A);
    }
    /**
     * Add an scheduled item
     *
     * @param $date
     * @param $sender
     * @param $message
     * @param $recipient
     * @param int $status | 1 = on queue, 2 = sent
     * @param array $media
     * @return false|int
     */
    public static function add($date, $sender, $message, $recipient, $status = 1, $media = [])
    {
        global $wpdb;
        /**
         * Backward compatibility
         * @todo Remove this if the length of the sender is increased in database
         */
        if (\strlen($sender) > 20) {
            $sender = \substr($sender, 0, 20);
        }
        return $wpdb->insert($wpdb->prefix . "sms_scheduled", array('date' => get_gmt_from_date($date), 'sender' => $sender, 'message' => $message, 'recipient' => \implode(',', $recipient), 'media' => \serialize($media), 'status' => $status));
    }
    /**
     * Update an scheduled item
     *
     * @param $schedule_id
     * @param $date
     * @param $message
     * @param $sender
     * @param int $status | 1 = on queue, 2 = sent
     *
     * @return false|int
     */
    public static function update($schedule_id, $date, $message, $sender, $status)
    {
        global $wpdb;
        return $wpdb->update($wpdb->prefix . "sms_scheduled", array('date' => get_gmt_from_date($date), 'sender' => $sender, 'message' => $message, 'status' => $status), array('ID' => $schedule_id));
    }
    /**
     * Update only Status of an scheduled item
     *
     * @param $schedule_id
     * @param int $status | 1 = on queue, 2 = sent
     *
     * @return false|int
     */
    public static function updateStatus($schedule_id, $status)
    {
        global $wpdb;
        return $wpdb->update($wpdb->prefix . "sms_scheduled", array('status' => $status), array('ID' => $schedule_id));
    }
    /**
     * Check cron and add if not available
     *
     * @param $schedules
     *
     * @return mixed
     */
    public function check_cron($schedules)
    {
        if (!isset($schedules['5min_wpsms'])) {
            $schedules['5min_wpsms'] = array('interval' => apply_filters('wp_sms_pro_scheduled_interval', 5 * 60), 'display' => __('WP SMS Pro Scheduled SMS cron', 'wp-sms-pro'));
        }
        return $schedules;
    }
    /**
     * Add cron event
     */
    public function schedule_wpsms_cron()
    {
        wp_schedule_event(\time(), '5min_wpsms', 'wpsms_send_schedule_sms', array());
    }
    /**
     * Send messages
     */
    public function send_sms_scheduled()
    {
        $table_name = $this->db->prefix . 'sms_scheduled';
        $time = \date('Y-m-d H-i-s', \time());
        $scheduled_items = $this->db->get_results("SELECT * FROM {$table_name} WHERE date <= '{$time}' AND status = '1'", ARRAY_A);
        if ($scheduled_items) {
            foreach ($scheduled_items as $item) {
                $to = \explode(',', $item['recipient']);
                $from = $item['sender'];
                $msg = $item['message'];
                $media = [];
                if ($item['media']) {
                    $media = \unserialize($item['media']);
                }
                wp_sms_send($to, $msg, null, $from, $media);
                self::updateStatus($item['ID'], 2);
            }
        }
    }
}
new \WP_SMS\Pro\Scheduled();
