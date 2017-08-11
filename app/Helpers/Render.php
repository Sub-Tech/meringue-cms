<?php

namespace App\Helpers;

use App\Page;

class Render
{
    public static $pageOutput = 'Page';

    /**
     * Render the page for the front end
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function page(Page $page)
    {
        self::$pageOutput .= self::renderHeader();
        echo self::$pageOutput;
    }


    /**
     * Render the header for the front end from
     */
    public static function renderHeader()
    {
        self::$pageOutput = view(env('THEME') . '/header', [
            'tits' => 'wonderful'
        ]);
    }


}