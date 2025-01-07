<?php

namespace WPSmsPro\Vendor\Twilio;

class InstanceContext
{
    protected $version;
    protected $solution = [];
    protected $uri;
    public function __construct(Version $version)
    {
        $this->version = $version;
    }
    public function __toString() : string
    {
        return '[InstanceContext]';
    }
}
