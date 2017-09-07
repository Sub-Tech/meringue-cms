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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|null
     */
    public function index(PageRenderer $renderer, string $slug = '/')
    {
        try {
            $page = Page::whereSlug($slug);
            return $renderer->page($page->firstOrFail());
        } catch (\Exception $exception) {
            return abort(404);
        }
    }

}
