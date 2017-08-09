<?php

namespace App\Http\Controllers;

use App\PluginBase;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    public function __construct()
    {
        new PluginBase(); // Auto load all the plugins
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
