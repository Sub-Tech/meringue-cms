<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use App\PluginBase;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Manage pages
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        $data['pages'] = Page::get();
        return view('admin.page.manage', $data);
    }


    public function edit(Page $page) {
        $data['page'] = $page;
        return view('admin.page.edit', $data);
    }
}
