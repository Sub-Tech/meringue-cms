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
        try {
            $this->install($plugin);
        } catch (\Exception $e) {
            return new AjaxResponse($message = $e->getMessage(), $success = false);
        }

        $plugin->active = 1;
        $plugin->save();

        return new AjaxResponse($message = 'Activation successful', $success = true);
    }



    public function destroy(Plugin $plugin)
    {
        // run rollbacks
        // set active = 0;

        try {
            $this->uninstall($plugin);
        } catch (\Exception $e) {
            return new AjaxResponse($message = $e->getMessage(), $success = false);
        }

        $plugin->active = 0;
        $plugin->save();

        return new AjaxResponse($message = 'Activation successful', $success = true);

    }

}
