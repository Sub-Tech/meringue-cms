<?php

namespace App\Renderers;

use App\Block;
use App\Plugin\PluginInitialiser;
use App\InstanceInterface;

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
    public function render(Block $block)
    {
        $plugin = PluginInitialiser::getPlugin($block->plugin_class);

        if ($plugin->implements(InstanceInterface::class) && is_null($block->instance_id)) {
            return "<span style='color:red'>Content not set for block {$block->id}!</span>";
        }

        return "<div class='block col-md-{$block->width}'>" .
            $plugin->render($block->instance_id) .
            "</div>";
    }

}