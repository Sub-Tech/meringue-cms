<?php

namespace App\Renderers;

use App\Block;
use App\Helpers\PluginInitialiser;

/**
 * Class BlockRenderer
 * @package App\Helpers
 */
class BlockRenderer
{

    /**
     * Open the section
     * @param Block $block
     * @return string
     */
    public function render(Block $block)
    {
        $plugin = PluginInitialiser::getPlugin($block->plugin_class);

        return "<div class='block col-md-{$block->width}'>" .
            $plugin->render($block->instance_id) .
            "</div>";
    }

}