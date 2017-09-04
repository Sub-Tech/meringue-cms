<?php

namespace App\Http\Controllers\Admin;

use App\Plugin\PluginInitialiser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

/**
 * Class PluginController
 * @package App\Http\Controllers\Admin
 */
class PluginController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @param PluginInitialiser $pluginInitialiser
     * @return \Illuminate\Http\Response
     */
    public function index(PluginInitialiser $pluginInitialiser)
    {
        return View::make('admin.plugin.manage', [
            'plugins' => $pluginInitialiser->plugins
        ]);
    }

}
