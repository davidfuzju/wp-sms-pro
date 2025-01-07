<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $MessageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    $Hlr = new \WPSmsPro\Vendor\MessageBird\Objects\Hlr();
    $Hlr->msisdn = 31612345678;
    $Hlr->reference = "Custom reference";
    try {
        $HlrResult = $MessageBird->hlr->create($Hlr);
        \var_export($HlrResult);
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\AuthenticateException $e) {
        // That means that your accessKey is unknown
        echo 'wrong login';
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\BalanceException $e) {
        // That means that you are out of credits, so do something about it.
        echo 'no balance';
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\RequestException $e) {
        echo $e->getMessage();
    }
}
