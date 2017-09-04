<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Plugin\PluginInitialiser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Class PluginController
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
        $plugin = PluginInitialiser::getPlugin(class_path($request->vendor, $request->plugin));

        Block::whereId($request->input('block_id'))
            ->update(['instance_id' => $plugin->saveInstance($request)]);

        return Redirect::back();
    }


    /**
     * Update the Instance of the Plugin
     *
     * @param Request $request
     * @param int $instanceId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $instanceId)
    {
        PluginInitialiser::getPlugin(class_path($request->vendor, $request->plugin))
            ->updateInstance($instanceId, $request);

        return Redirect::back();
    }

}
