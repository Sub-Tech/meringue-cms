<?php

namespace App\Renderers;

/**
 * Class BlockRenderer
 * @package App\Helpers
 */
class HeaderRenderer
{

    /**
     * Render the header
     *
     * @return View
     */
    public static function render()
    {
        return view(config('theme.default') . '/header');
    }

}