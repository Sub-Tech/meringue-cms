<?php

namespace App\Renderers;

use App\Block;

/**
 * Class ModalRenderer
 * @package App\Renderers
 */
class ModalRenderer
{

    /**
     * Render the Modal
     *
     * @param $block
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function render(Block $block)
    {
        return view('admin.plugin.edit', [
            'block' => $block
        ]);
    }

}