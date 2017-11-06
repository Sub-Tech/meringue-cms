<?php

/**
 * Returns a public file path to a asset, css, js or image
 *
 * @return mixed
 */
if (!function_exists('theme_asset')) {
    function theme_asset($asset)
    {
        return URL::to('/themes/' . config('theme.default') . '/' . $asset);
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


/**
 * Converts a form label to name
 * "What is your age?" becomes "what_is_your_age"
 * For rendering the form
 */
if (!function_exists('convert_label_to_name')) {
    function label_to_name($label)
    {
        // Replace all spaces with underscores and make it all lower case
        $snaked = str_replace(' ', '_', strtolower($label));

        // Remove anything not a-z
        return preg_replace("/[^a-z_]+/", "", $snaked);
    }
}


/**
 * Gets the file type and returns the correct content type
 */
if (!function_exists('get_content_type')) {
    function get_content_type(string $filePath): string
    {
        switch (pathinfo($filePath, PATHINFO_EXTENSION)) {
            case 'js':
                return 'text/javascript';
            case 'css':
                return 'text/css';
            case 'png':
                return 'image/png';
            default:
                throw new Exception("Unknown file type", 500);
        }
    }
}
