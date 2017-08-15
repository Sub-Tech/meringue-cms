<?php

namespace App\Http\Controllers;

use App\Helpers\PluginInitialiser;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Controller constructor.
     * @param PluginInitialiser $initialiser
     */
    public function __construct(PluginInitialiser $initialiser)
    {
        $initialiser->loadAll();
    }

}
