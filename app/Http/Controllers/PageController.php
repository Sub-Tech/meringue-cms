<?php

namespace App\Http\Controllers;

use App\Renderers\PageRenderer;
use App\Page;

class PageController extends Controller
{

    /**
     * Render Page via passed slug
     *
     * @param PageRenderer $renderer
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(PageRenderer $renderer, string $slug)
    {
        $page = Page::whereSlug($slug)->get()->first();

        return $renderer->page($page);
    }

}
