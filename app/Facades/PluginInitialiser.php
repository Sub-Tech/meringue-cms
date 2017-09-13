<?php

namespace App\Facades;

use App\Plugin\PluginBase;
use Illuminate\Support\Facades\Facade;

/**
 * Class PluginInitialiserFacade
 * @package App\Facades
 *
 * @method static PluginBase getPlugin(string $class)
 * @method initialiseRoutes()
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