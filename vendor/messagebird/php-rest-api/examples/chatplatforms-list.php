<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $MessageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    $ChatPlatform = new \WPSmsPro\Vendor\MessageBird\Objects\Chat\Channel();
    try {
        $ChatPlatformResult = $MessageBird->chatPlatforms->getList();
        \var_dump($ChatPlatformResult);
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\AuthenticateException $e) {
        // That means that your accessKey is unknown
        echo 'wrong login';
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
