<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

/**
 * Class RetrieveAsset
 * @package App\Http\Middleware
 */
class RetrieveAsset
{

    const ALLOWED_FILE_TYPES = [
        'js',
        'css',
        'png'
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

        $filePath = array_pop(explode('assets/', $request->url()));

        $contents = file_get_contents(base_path($filePath));

        return Response::make($contents)
            ->header('Content-Type', get_content_type($filePath));
    }

}
