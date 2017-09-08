<?php

namespace App\Renderers\Admin;

use App\Block;
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
        // Called once to speed up rendering
        $plugin = $block->plugin;

        return View::make('admin.plugin.modal')
            ->with('block', $block)
            ->with('plugin', $plugin)
            ->with('editSettings', $plugin->constructEditorModal())
            ->with('instance', $instanceId ? $plugin->getInstance($instanceId) : null);
    }

}