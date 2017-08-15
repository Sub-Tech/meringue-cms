<?php

/**
 * Returns a public file path to a asset, css, js or image
 *
 * @return mixed
 */
if (!function_exists('theme_asset')) {
    function theme_asset($asset)
    {
        return URL::to('/themes/' . env('THEME') . '/' . $asset);
    }
}

/**
 * Removes the '.' and '..' from the directory path
 *
 * @param $pathArray
 * @return array
 */
if (!function_exists('trim_directory_path')) {
    function trim_directory_path($pathArray)
    {
        unset($pathArray[0], $pathArray[1]);

        return $pathArray;
    }
}


/**
 * Returns the plugin's file path
 *
 * @return string
 */
if (!function_exists('file_path')) {
    function file_path(string $vendor, string $plugin)
    {
        return "plugins/{$vendor}/{$plugin}/{$plugin}.php";
    }
}


/**
 * Returns the plugin's class path
 *
 * @return string
 */
if (!function_exists('class_path')) {
    function class_path(string $vendor, string $plugin)
    {
        return "Plugins\\" . $vendor . "\\" . $plugin . "\\" . $plugin;
    }
}
