<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ->with('pages', Page::all());
    }


    /**
     * Display the form to create the shit
     */
    public function create()
    {
        return view('admin.page.create');
    }


    /**
     * Create a new Page
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $page = Page::create(array_merge(
            $request->all(), [
            'user_id' => Auth::check()
        ]));

        return redirect(route('admin.page.edit', [
            'page' => $page
        ]));
    }


    /**
     * Edit a Page / Sections / Blocks
     *
     * @param Page $page
     * @return $this
     */
    public function edit(Page $page)
    {
        return view('admin.page.edit')
            ->with('page', $page)
            ->with('plugins', $this->pluginInitialiser->plugins);
    }

}
