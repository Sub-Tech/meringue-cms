<?php

namespace App\Renderers\Admin;

use App\Block;
use App\Plugin\PluginInitialiser;
use Illuminate\Support\Facades\View;

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
        return View::make('admin.plugin.modal')
            ->with('block', $block)
            ->with('plugin', $block->plugin)
            ->with('editSettings', $block->plugin->constructEditorModal())
            ->with('instance', $instanceId ? $block-.plugin->getInstance($instanceId) : null);
    }

}