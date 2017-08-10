<?php

namespace App\Http\Controllers;

use App\Helpers\Render;
use App\Page;

class PageController extends Controller
{

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($slug = '/')
    {
        $page = Page::whereSlug($slug)->get();

        if ($page->count() == 0) {
            echo "404"; //TODO : Create 404 page
        }

        return Render::page($page->first());
    }

}
