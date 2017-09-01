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
    public function index(PageRenderer $renderer, string $slug = null)
    {
//      dd($renderer->page(($slug ? Page::whereSlug($slug) : Page::whereHomepage(1))->firstOrFail()));

        try {
            return $renderer->page((
            $slug ?
                Page::whereSlug($slug) :
                Page::whereHomepage(1)
            )->firstOrFail());
        } catch (\Exception $exception) {
            return abort(404);
        }
    }

}
