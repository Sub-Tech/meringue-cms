<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;

/**
 * Class PageController
 * @package App\Http\Controllers\Admin
 */
class PageController extends Controller
{

    /**
     * Manage pages
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        return view('admin.page.manage')
            ->with('pages', Page::get());
    }


    public function edit(Page $page)
    {
        return view('admin.page.edit')
            ->with('page', $page);
    }

}
