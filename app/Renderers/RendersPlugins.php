<?php

namespace App\Renderers;

use App\Block;

/**
 * Trait RendersPlugins
 * @package App\Renderers
 */
trait RendersPlugins
{

    /**
     * Checks the plugins array for inactive plugins
     *
     * @param Block $block
     * @return bool
     */
    private function isTryingToRenderAnInactivePlugin(Block $block)
    {
        return !$this->pluginInitialiser->plugins->has($block->plugin_class);
    }

}
