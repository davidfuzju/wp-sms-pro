<?php

namespace {
    require_once __DIR__ . '/../autoload.php';
    $messageBird = new \WPSmsPro\Vendor\MessageBird\Client('YOUR_ACCESS_KEY');
    // Set your own API access key here.
    $call = new \WPSmsPro\Vendor\MessageBird\Objects\Voice\Call();
    $call->source = '31971234567';
    $call->destination = '31612345678';
    $callFlow = new \WPSmsPro\Vendor\MessageBird\Objects\Voice\CallFlow();
    $callFlow->title = 'Say message';
    $step = new \WPSmsPro\Vendor\MessageBird\Objects\Voice\Step();
    $step->action = 'say';
    $step->options = array('payload' => 'This is a journey into sound.', 'language' => 'en-GB', 'voice' => 'male');
    $callFlow->steps = array($step);
    $call->callFlow = $callFlow;
    try {
        $result = $messageBird->voiceCalls->create($call);
        \var_dump($result);
    } catch (\Exception $e) {
        echo \sprintf("%s: %s", \get_class($e), $e->getMessage());
    }
}
