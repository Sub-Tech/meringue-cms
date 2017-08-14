<?php

/**
 * Returns a public file path to a asset, css, js or image
 *
 * @return mixed
 */
if(!function_exists('theme_asset')) {
    function theme_asset($asset)
    {
        return URL::to('/themes/' . env('THEME') . '/' . $asset);
    }
}
