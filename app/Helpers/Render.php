<?php

namespace App\Helpers;

use App\Page;

class Render
{

    /**
     * Render the page for the front end
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function page(Page $page)
    {
        return self::renderHeader();
    }


    /**
     * Render the header for the front end from
     */
    public static function renderHeader()
    {
        return view(env('THEME') . '/header', [
            'tits' => 'wonderful'
        ]);
    }


}