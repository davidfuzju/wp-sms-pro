<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $MessageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    $ChatChannel = new \WPSmsPro\Vendor\MessageBird\Objects\Chat\Channel();
    $ChatChannel->name = 'New name';
    $ChatChannel->callbackUrl = 'http://newurl.dev';
    try {
        $ChatChannelResult = $MessageBird->chatChannels->update($ChatChannel, '331af4c577e3asbbc3631455680736');
        \var_dump($ChatChannelResult);
    } catch (\WPSmsPro\Vendor\MessageBird\Exceptions\AuthenticateException $e) {
        // That means that your accessKey is unknown
        echo 'wrong login';
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
