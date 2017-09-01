<?php

namespace App\Http\Controllers\Admin;

use App\Plugin\PluginInitialiser;
use App\Http\Controllers\Controller;
use App\Plugin;
use App\Responses\AjaxResponse;
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
     * @return AjaxResponse
     */
    public function activate(Request $request)
    {
        $plugin = Plugin::find($request->plugin);

        if ($plugin->active) {
            return new AjaxResponse($message = 'Plugin already activated', $success = false);
        }

        if (!$plugin->installed) {
            try {
                PluginInitialiser::getPlugin($plugin->class_name)->install();
                $plugin->installed = 1;
            } catch (\Exception $e) {
                return new AjaxResponse($message = $e->getMessage(), $success = false);
            }
        }

        $plugin->active = 1;
        $plugin->save();

        return new AjaxResponse($message = 'Activation successful', $success = true);
    }

}
