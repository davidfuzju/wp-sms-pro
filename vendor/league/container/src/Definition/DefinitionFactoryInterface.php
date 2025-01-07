<?php

namespace WPSmsPro\Vendor\League\Container\Definition;

use WPSmsPro\Vendor\League\Container\ImmutableContainerAwareInterface;
interface DefinitionFactoryInterface extends ImmutableContainerAwareInterface
{
    /**
     * Return a definition based on type of concrete.
     *
     * @param  string $alias
     * @param  mixed  $concrete
     * @return mixed
     */
    public function getDefinition($alias, $concrete);
}
