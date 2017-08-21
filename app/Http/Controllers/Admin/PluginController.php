<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\PluginInitialiser;
use App\Http\Controllers\Controller;
use App\Plugin;
use App\PluginBase;
use Illuminate\Http\Request;
use Prophecy\Exception\Doubler\MethodNotFoundException;

class PluginController extends Controller
{

    /**
     * @var PluginBase
     */
    protected $pluginBase;

    /**
     * PluginController constructor.
     * @param PluginInitialiser $pluginInitialiser
     */
    public function __construct(PluginInitialiser $pluginInitialiser)
    {
        parent::__construct($pluginInitialiser);

        $this->pluginBase = new PluginBase();
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view('admin.plugin.manage', [
            'plugins' => $this->pluginInitialiser->plugins
        ]);
    }


    /**
     * Activates the Plugin
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(Request $request)
    {
        $plugin = Plugin::find($request->plugin);

        if ($plugin->active) {
            return response()->json([
                'success' => false,
                'message' => 'Plugin already activated'
            ]);
        }

        if (!$plugin->installed) {
            try {
                $this->pluginInitialiser->getPlugin($plugin->class_name)->install();
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
            $plugin->installed = 1;
        }

        $plugin->active = 1;
        $plugin->save();

        return response()->json([
            'success' => true
        ]);
    }


    /**
     * Refresh the block registry in the database
     */
    public function refreshBlocksRegistry()
    {
        return $this->pluginBase->refreshBlockRegistry();
    }


    /**
     * Create Instance of a Plugin and assign it to a Block
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function createInstance(Request $request)
    {
        $plugin = $this->pluginInitialiser->getPlugin(class_path($request->vendor, $request->plugin));

        if (!method_exists($plugin, 'saveInstance')) {
            throw new \Exception('Method not found', 500);
        }

        $instanceId = $plugin->saveInstance($request);

        return redirect(route('block.update', [
            'block' => $request->input('block_id')
        ]))->with('instance_id', $instanceId);
    }

}
