<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $MessageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    $Group = new \WPSmsPro\Vendor\MessageBird\Objects\Group();
    $Group->name = "group_name";
    try {
        $GroupResult = $MessageBird->groups->create($Group);
        \var_dump($GroupResult);
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\AuthenticateException $e) {
        // That means that your accessKey is unknown
        echo 'Wrong login';
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
