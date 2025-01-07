<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $MessageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    $Contact = new \WPSmsPro\Vendor\MessageBird\Objects\Contact();
    $Contact->msisdn = '31123456789';
    $Contact->firstName = 'ChangedFirst';
    $Contact->lastName = "ChangedLast";
    $Contact->custom1 = "custom-1b";
    $Contact->custom2 = "custom-2b";
    $Contact->custom3 = "custom-3b";
    $Contact->custom4 = "custom-4b";
    try {
        $GroupResult = $MessageBird->contacts->update($Contact, 'contact_id');
        \var_dump($GroupResult);
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\AuthenticateException $e) {
        // That means that your accessKey is unknown
        echo 'Wrong login';
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
