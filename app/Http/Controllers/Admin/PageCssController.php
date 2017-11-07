<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Class PageCssController
 * @package App\Http\Controllers\Admin
 */
class PageCssController extends Controller
{

    /**
     * Update a Section and return if it worked or not
     *
     * @param Request $request
     * @param Page $page
     * @return RedirectResponse
     */
    public function update(Request $request, Page $page)
    {
        $page->update($request->all());

        return Redirect::back();
    }

}
