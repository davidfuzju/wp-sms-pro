<?php

namespace WPSmsPro\Vendor\MessageBird\Objects;

/**
 * Class Base
 *
 * @package MessageBird\Objects
 */
class Base
{
    /**
     * @param $object
     *
     * @return $this
     */
    public function loadFromArray($object)
    {
        if ($object) {
            foreach ($object as $key => $value) {
                if (\property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
        return $this;
    }
}
