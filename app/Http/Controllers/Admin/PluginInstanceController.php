<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use Illuminate\Http\Request;
use App\Plugin\PluginInitialiser;
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
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $instanceId = PluginInitialiser::getPlugin(class_path($request->vendor, $request->plugin))
            ->saveInstance($request);

        Block::whereId($request->input('block_id'))
            ->update(['instance_id' => $instanceId]);

        return Redirect::back();
    }


    /**
     * Update the Instance of the Plugin
     *
     * @param Request $request
     * @param int $instanceId
     * @return AjaxResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $instanceId)
    {
        PluginInitialiser::getPlugin(class_path($request->vendor, $request->plugin))
            ->updateInstance($instanceId, $request);

        if ($request->ajax()) {
            return new AjaxResponse('Instance updated', true);
        }

        return Redirect::back();
    }

}
