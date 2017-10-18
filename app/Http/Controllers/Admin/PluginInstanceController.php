<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Plugin\PluginBase;
use Illuminate\Http\Request;
use App\Http\Responses\AjaxResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

/**
 * Class PluginInstanceController
 * @package App\Http\Controllers\Admin
 */
class PluginInstanceController extends Controller
{

    /**
     * Create Instance of a Plugin and assign it to a Block
     *
     * @param Request $request
     * @param PluginBase $plugin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, PluginBase $plugin)
    {
        $instanceId = $plugin->saveInstance($request);

        Block::whereId($request->input('block_id'))
            ->update([
                'instance_id' => $instanceId
            ]);

        return Redirect::back();
    }


    /**
     * Update the Instance of the Plugin
     *
     * @param Request $request
     * @param PluginBase $plugin
     * @param int $instanceId
     * @return AjaxResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PluginBase $plugin, int $instanceId)
    {
        $plugin->updateInstance($instanceId, $request);

        if ($request->ajax()) {
            return new AjaxResponse('Instance updated', true);
        }

        return Redirect::back();
    }

}
