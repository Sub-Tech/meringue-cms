<?php

namespace App\Renderers;

use App\Helpers\PluginInitialiser;

/**
 * Class BlockRenderer
 * @package App\Helpers
 */
class AdminMenuRenderer
{

    /**
     * Renders the Side Menu
     *
     * @return array
     */
    public static function getSideBarMenuItems()
    {
        $pluginInitialiser = app(PluginInitialiser::class);

        $menu = [];

        $pluginInitialiser->plugins->each(function ($plugin) use (&$menu) {
            $pluginClass = pluginInitialiser::getPlugin($plugin->class);

            if (method_exists($pluginClass, 'registerSideBarMenuItem')) {
                $menu[] = $pluginClass->registerSideBarMenuItem();
            }
        });

        return $menu;
    }

}