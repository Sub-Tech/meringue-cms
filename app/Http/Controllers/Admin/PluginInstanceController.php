<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Helpers\PluginInitialiser;
use App\Http\Controllers\Controller;
use App\InstanceInterface;
use Illuminate\Http\Request;

/**
 * Class PluginController
 * @package App\Http\Controllers\Admin
 */
class PluginInstanceController extends Controller
{

    /**
     * @var PluginInitialiser
     */
    private $pluginInitialiser;


    /**
     * PluginController constructor.
     * @param PluginInitialiser $pluginInitialiser
     */
    public function __construct(PluginInitialiser $pluginInitialiser)
    {
        $this->pluginInitialiser = $pluginInitialiser;
    }


    /**
     * Create Instance of a Plugin and assign it to a Block
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        /** @var InstanceInterface $plugin */
        $plugin = $this->pluginInitialiser->getPlugin(class_path($request->vendor, $request->plugin));

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
        /** @var InstanceInterface $plugin */
        $plugin = $this->pluginInitialiser->getPlugin(class_path($request->vendor, $request->plugin));

        $plugin->updateInstance($instanceId, $request);

        return redirect()->back();
    }

}
