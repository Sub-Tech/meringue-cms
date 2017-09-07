<?php

namespace App\Http\Controllers;

use App\Renderers\PageRenderer;
use App\Page;

/**
 * Class PageController
 * @package App\Http\Controllers
 */
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
            $page = Page::whereSlug($slug)->firstOrFail();
            return PageRenderer::render($page);
        } catch (\Exception $exception) {
            return abort(404);
        }
    }

}
