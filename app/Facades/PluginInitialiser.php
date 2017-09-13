<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PluginInitialiserFacade
 * @package App\Facades
 */
class PluginInitialiser extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'PluginInitialiser';
    }

}