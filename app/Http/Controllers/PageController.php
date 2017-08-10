<?php

namespace App\Http\Controllers;

use App\Helpers\Render;
use App\Helpers\Theme;
use App\Page;
use App\Section;
use Illuminate\Http\Request;

class PageController extends Controller
{

    /**
     * @param string $slug
     */
    public function index($slug = '/')
    {
        $page = Page::where('slug', $slug); // or create a helper on your model to condense this
        if($page->count() == 0) {
           echo "404"; //TODO : Create 404 page
        }
        return (new Render())->renderPage($page->first());
    }





}
