<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $MessageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    try {
        $deleted = $MessageBird->mmsMessages->delete('mms_message_id');
        // id here
        \var_dump('Deleted: ' . $deleted);
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\AuthenticateException $e) {
        // That means that your accessKey is unknown
        echo 'wrong login';
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\BalanceException $e) {
        // That means that you are out of credits, so do something about it.
        echo 'no balance';
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
