<?php

namespace App\Renderers;

use App\Block;
use App\Helpers\PluginInitialiser;

/**
 * Class ModalRenderer
 * @package App\Renderers
 */
class ModalRenderer
{

    /**
     * Render the Modal
     *
     * @param Block $block
     * @param int|null $instanceId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function render(Block $block, int $instanceId = null)
    {
        $plugin = PluginInitialiser::getPlugin($block->plugin->class_name);

        return view('admin.plugin.modal')
            ->with('block', $block)
            ->with('plugin', $plugin)
            ->with('editSettings', $plugin->registerBlock())
            ->with('instance', $instanceId ? $plugin->getInstance($instanceId) : null);
    }

}