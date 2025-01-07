<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $MessageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    $ChatMessage = new \WPSmsPro\Vendor\MessageBird\Objects\Chat\Message();
    try {
        $ChatMessageResult = $MessageBird->chatMessages->getList();
        \var_dump($ChatMessageResult);
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\AuthenticateException $e) {
        // That means that your accessKey is unknown
        echo 'wrong login';
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
