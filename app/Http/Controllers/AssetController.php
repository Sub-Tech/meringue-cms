<?php

namespace App\Http\Controllers;

use App\Http\Requests\RetrieveAsset;
use Illuminate\Support\Facades\Response;

/**
 * Class AssetController
 * @package App\Http\Controllers
 */
class AssetController extends Controller
{

    /**
     * Show the defined asset
     *
     * @param RetrieveAsset $request
     * @param string $filePath
     * @return \Illuminate\Http\Response
     */
    public function show(RetrieveAsset $request, string $filePath)
    {
        return Response::make(
            file_get_contents(base_path($filePath))
        )->header('Content-Type', get_content_type($filePath));
    }

}
