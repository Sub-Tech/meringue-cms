<?php

namespace App\Helpers;

use App\Block;

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
        $p = PluginInitialiser::getPlugin($block->plugin_class);

        return "<div class='block'>" . $p->render() . "</div>";
    }

}