<?php

namespace App\Helpers;

use App\Plugin;
use App\Plugin\PluginInitialiser;

/**
 * Trait InstallsPlugins
 * @package App\Helpers
 */
trait InstallsPlugins
{

    /**
     * Tries to install the plugin if it hasn't already
     *
     * @param Plugin $plugin
     */
    private function install(Plugin &$plugin)
    {
        if (!$plugin->installed) {
            PluginInitialiser::getPlugin($plugin->class_name)->install();

            $plugin->installed = 1;
        }
    }

}