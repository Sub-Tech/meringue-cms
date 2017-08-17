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
     * View the dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }

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


    public function edit($page_id)
    {
        $page = Page::findOrFail($page_id);

        return view('admin.page.edit')
            ->with('page', $page);
    }

}
