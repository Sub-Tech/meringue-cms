<?php

namespace App\Helpers;

use App\Block;
use App\Plugin\PluginInitialiser;

/**
 * Trait RendersPlugins
 * @package App\Helpers
 */
trait RendersPlugins
{

    /**
     * Checks the plugins array for inactive plugins
     * @return bool
     */
    public function isTryingToRenderAnInactivePlugin()
    {
        $pluginInitialiser = app(PluginInitialiser::class);

        return !$pluginInitialiser->plugins->has($this->plugin_class);
    }


    /**
     * Checks to see whether the Plugin being rendered has any dependencies
     * If it does and the dependency is unavailable, render nothing
     *
     * @return bool
     */
    public function pluginDependsOnAnInactivePlugin()
    {
        /** @var Block $this */
        if (isset($this->getPlugin()->requires)) {
            try {
                $this->getPlugin()->requires($this->getPlugin()->requires);
            } catch (\Exception $exception) {
                return true;
            }
        }

        return false;
    }

}
