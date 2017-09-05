<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Http\Controllers\Controller;
use App\Renderers\Admin\ModalRenderer;

/**
 * Class PluginController
 * @package App\Http\Controllers\Admin
 */
class PluginModalController extends Controller
{

    /**
     * Render the Modal to edit an Instance of the Plugin
     *
     * @param Block $block
     * @param int|null $instanceId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Block $block, int $instanceId = null)
    {
        return ModalRenderer::render($block, $instanceId);
    }

}
