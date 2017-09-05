<?php

namespace App\Plugin;

/**
 * Trait ImplementsInterfaces
 * @package App\Plugin
 */
trait ImplementsInterfaces
{

    /**
     * Check to see if the Plugin implements a given Interface
     *
     * @param string $class
     * @return bool
     */
    public function implements(string $class)
    {
        return in_array($class, class_implements($this));
    }

}