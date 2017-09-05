<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\InstallsPlugins;
use App\Http\Controllers\Controller;
use App\Http\Responses\AjaxResponse;
use App\Plugin;

/**
 * Class PluginController
 * @package App\Http\Controllers\Admin
 */
class PluginActivationController extends Controller
{
    use InstallsPlugins;

    /**
     * Activates the Plugin
     *
     * @param Plugin $plugin
     * @return AjaxResponse
     */
    public function store(Plugin $plugin)
    {
        if ($plugin->active) {
            return new AjaxResponse($message = 'Plugin already activated', $success = false);
        }

        try {
            $this->install($plugin);
        } catch (\Exception $e) {
            return new AjaxResponse($message = $e->getMessage(), $success = false);
        }

        $plugin->active = 1;
        $plugin->save();

        return new AjaxResponse($message = 'Activation successful', $success = true);
    }


    public function destroy()
    {
        // run rollbacks
        // set active = 0;
    }

}
