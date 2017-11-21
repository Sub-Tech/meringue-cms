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
        if (!str_contains($request->url(), "assets/")) {
            return $next($request);
        }

        $requestedFileType = array_pop(explode('.', $request->url()));

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
        $path = explode('assets/', $request->url());
        $path = array_shift($path);
        return implode('', $path);
    }

}
