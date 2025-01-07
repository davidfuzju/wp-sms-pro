<?php

namespace WPSmsPro\Vendor\Twilio;

abstract class Options implements \IteratorAggregate
{
    protected $options = [];
    public function getIterator() : \Traversable
    {
        return new \ArrayIterator($this->options);
    }
}
