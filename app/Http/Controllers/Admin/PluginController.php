<?php

namespace App\Http\Controllers\Admin;

use App\Plugin;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('admin.plugin.manage', [
            'plugins' => Plugin::all()
        ]);
    }

}
