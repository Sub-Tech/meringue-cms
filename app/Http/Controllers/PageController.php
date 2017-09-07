<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
            return Page::render($slug);
        } catch (ModelNotFoundException $exception) {
            return abort(404);
        } catch (\Exception $exception) {
            return abort(500);
        }
    }

}
