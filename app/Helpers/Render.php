<?php
/**
 * Created by PhpStorm.
 * User: jameslewis
 * Date: 10/08/2017
 * Time: 12:39
 */

namespace App\Helpers;


use App\Page;

class Render
{
    protected $theme;

    public function __construct()
    {
        $this->theme = env('THEME');
    }

    /**
     * Render the page for the front end
     * @param Page $page
     */
    public function renderPage(Page $page) {
        return $this->renderHeader();
        // do some more rendering blox
    }

    /**
     * Render the header for the front end from
     */
    public function renderHeader() {
       return view($this->theme . '/header');
    }


}