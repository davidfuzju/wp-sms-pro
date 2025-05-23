<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $MessageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    try {
        $HlrList = $MessageBird->hlr->getList(array('offset' => 100, 'limit' => 30));
        \var_dump($HlrList);
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\AuthenticateException $e) {
        // That means that your accessKey is unknown
        echo 'wrong login';
    } catch (\Exception $e) {
        \var_dump($e->getMessage());
    }
}
