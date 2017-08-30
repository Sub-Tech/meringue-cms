<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\PluginInitialiser;
use App\Http\Controllers\Controller;
use App\Plugin;
use Illuminate\Http\Request;

/**
 * Class PluginController
 * @package App\Http\Controllers\Admin
 */
class PluginController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

}
