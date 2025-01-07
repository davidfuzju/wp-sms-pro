<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $MessageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    $Contact = new \WPSmsPro\Vendor\MessageBird\Objects\Contact();
    $Contact->msisdn = "31123456780";
    $Contact->firstName = "FirstName";
    $Contact->lastName = "LastName";
    $Contact->custom1 = "test_custom1";
    $Contact->custom2 = "test_custom2";
    $Contact->custom3 = "test_custom3";
    $Contact->custom4 = "test_custom4";
    try {
        $ContactResult = $MessageBird->contacts->create($Contact);
        \var_dump($ContactResult);
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\AuthenticateException $e) {
        // That means that your accessKey is unknown
        echo 'Wrong login';
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
