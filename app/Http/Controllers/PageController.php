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
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(PageRenderer $renderer, Page $page)
    {
        return $renderer->page($page->first());
    }

}
