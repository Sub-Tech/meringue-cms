<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class RetrieveAsset
 * @package App\Http\Middleware
 */
class RetrieveAsset
{

    /**
     * The bit of the URL before the resource path
     */
    const RESOURCE_PLACEHOLDER = "assets/";

    /**
     * Any allowed file types
     */
    const ALLOWED_FILE_TYPES = [
        'js',
        'css',
        'png',
        'jpg',
        'jpeg'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $i = str_contains($request->url(), self::RESOURCE_PLACEHOLDER);

        if (!$i) {
            return $next($request);
        }


        $requestedFileType = last(explode('.', $request->url()));

        if (!in_array($requestedFileType, self::ALLOWED_FILE_TYPES)) {
            return $next($request);
        }

        $filePath = $this->removeFirstAssetsSubstring($request);

        $contents = file_get_contents(base_path($filePath));

        return Response::make($contents)
            ->header('Content-Type', get_content_type($filePath));
    }

    /**
     * Remove the first instance of assets from the URL
     *
     * @param Request $request
     * @return string
     */
    private function removeFirstAssetsSubstring(Request $request)
    {
        $startOfResourcePath = strpos($request->url(), self::RESOURCE_PLACEHOLDER) + strlen(self::RESOURCE_PLACEHOLDER);

        return substr($request->url(), $startOfResourcePath);
    }

}
