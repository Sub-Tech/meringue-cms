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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function render(Block $block)
    {
        // Called once to speed up rendering
        $plugin = $block->plugin->class();

        return View::make('admin.plugin.modal')
            ->with('block', $block)
            ->with('plugin', $plugin)
            ->with('editSettings', $plugin->constructEditorModal())
            ->with('instance', $block->instance_id ? $plugin->getInstance($block->instance_id) : null);
    }

}