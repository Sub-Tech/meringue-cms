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
     *
     * @param Block $block
     * @return string (of HTML)
     */
    public function render(Block $block)
    {
        $plugin = PluginInitialiser::getPlugin($block->plugin_class);

        if ($this->blockRequiresInstanceOf($plugin) && is_null($block->instance_id)) {
            return "<span style='color:red'>Content not set for block {$block->id}!</span>";
        }

        return "<div class='block col-md-{$block->width}'>" .
            $plugin->render($block->instance_id) .
            "</div>";
    }


    /**
     * Checks to see if the Plugin requires an instance
     * or: see if it implements the Instance Interface
     *
     * @param $plugin
     * @return bool
     */
    private function blockRequiresInstanceOf($plugin)
    {
        return in_array('App\InstanceInterface', class_implements($plugin));
    }

}