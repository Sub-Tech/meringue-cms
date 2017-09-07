<?php

namespace App\Http\Controllers;

use App\Renderers\PageRenderer;
use App\Page;

class PageController extends Controller
{
    /**
     * Render Page via passed slug
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|null
     */
    public function index(string $slug = '/')
    {
        try {
            $page = Page::whereSlug($slug);
            return PageRenderer::render($page->firstOrFail());
        } catch (\Exception $exception) {
            return abort(404);
        }
    }

}
