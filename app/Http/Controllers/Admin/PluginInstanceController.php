<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Plugin\PluginInitialiser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        $instanceId = $plugin->saveInstance($request);

        Block::assignInstanceToBlock($request->input('block_id'), $instanceId);

        return redirect()->back();
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
        $plugin = PluginInitialiser::getPlugin(class_path($request->vendor, $request->plugin));

        $plugin->updateInstance($instanceId, $request);

        return redirect()->back();
    }

}
