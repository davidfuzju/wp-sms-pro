<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $MessageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    try {
        $GroupsContactList = $MessageBird->groups->getContacts('group_id');
        \var_dump($GroupsContactList);
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\AuthenticateException $e) {
        // That means that your accessKey is unknown
        echo 'Wrong login';
    } catch (\Exception $e) {
        \var_dump($e->getMessage());
    }
}
