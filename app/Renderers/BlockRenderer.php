<?php

namespace App\Renderers;

use App\Block;
use App\Plugin\InstanceInterface;

/**
 * Class BlockRenderer
 * @package App\Helpers
 */
class BlockRenderer
{

    /**
     * Open the section
     *
     * @param Block $block
     * @return string (of HTML)
     */
    public static function render(Block $block)
    {
        if ($block->isTryingToRenderAnInactivePlugin() || $block->pluginDependsOnAnInactivePlugin()) {
            return "";
        }

        if ($block->plugin->class()->implements(InstanceInterface::class) && is_null($block->instance_id)) {
            return "";
        }

        return
            "<div class='block col-md-{$block->width}'>"
            . $block->plugin->render($block->instance_id) .
            "</div>";
    }

}