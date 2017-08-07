<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use App\Plugin;
use App\PluginBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class PluginController extends Controller
{
    protected $pluginBase;

    protected $loadedPlugin;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pluginBase = new PluginBase();

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        $data['plugins'] = (new PluginBase)->getPluginsDetails();
        return view('admin.plugin.manage', $data);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate()
    {
        $plugin = Plugin::find(Input::get('plugin'));

        // If plugin is already active
        if ($plugin->active == 1) {
            return response()->json(['success' => false, 'message' => 'Plugin already activated']);
        }

        // If plugin not installed
        if($plugin->installed == 0 ) {
            // Try to run install script of plugin
            try {
                $this->load($plugin)->install();
            } catch (Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
            $plugin->installed = 1;
        }

        // Set plugin as active
        $plugin->active = 1;
        $plugin->save();

        return response()->json(['success' => true]);
    }

    /**
     * Refresh the plugins in the database
     */
    public function refreshPluginsRegistry()
    {
        $this->pluginBase->refreshPluginsRegistry();
    }

    /**
     * @param Plugin $plugin
     * @return mixed
     */
    public function load(Plugin $plugin)
    {
        if(!class_exists($plugin->class_name)){
            throw new Exception('Plugin ' . $plugin->name . ' by ' . $plugin->author . ' has not been found');
        }
        return new $plugin->class_name();
    }
}
