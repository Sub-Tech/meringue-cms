<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Response;

/**
 * Class Route
 * @package App\Helpers
 */
class Route extends \Illuminate\Support\Facades\Route
{

    /**
     * Easy way to bind plugin assets to a URI outside of the public folder
     *
     * @param string $uri
     * @param string $filePath
     * @return \Illuminate\Routing\Route
     */
    public static function asset(string $uri, string $filePath)
    {
        return parent::get($uri, function () use ($filePath) {
            return Response::make(
                file_get_contents($filePath)
            )->header('Content-Type', get_content_type($filePath));
        });
    }

}