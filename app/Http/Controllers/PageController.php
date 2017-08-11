<?php

namespace App\Http\Controllers;

use App\Helpers\PageRenderer;
use App\Page;

class PageController extends Controller
{

    /**
     * @param PageRenderer $renderer
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(PageRenderer $renderer, $slug = '/')
    {
        $page = Page::whereSlug($slug)->get();

        if ($page->count() == 0) {
            echo "404"; //TODO : Create 404 page
        }

        return $renderer->page($page->first());
    }

}
