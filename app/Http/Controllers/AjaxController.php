<?php

namespace App\Http\Controllers;

use App\Helpers\PluginInitialiser;
use Illuminate\Http\Request;

/**
 * Class FormController
 * @package App\Http\Controllers
 */
class AjaxController extends Controller
{

    /**
     * Handles the Request
     *
     * @param PluginInitialiser $pluginInitialiser
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(PluginInitialiser $pluginInitialiser, Request $request)
    {
        $classPath = class_path($request->vendor, $request->plugin);
        $plugin = $pluginInitialiser->getPlugin($classPath);

        if (!method_exists($plugin, 'handleAjax')) {
            return response()->json([
                'message' => 'Method not found'
            ]);
        }

        return $plugin->handleAjax($request);
    }

}
