<?php

namespace App\Http\Controllers\Admin;

use App\Facades\PluginInitialiser;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

/**
 * Class PageController
 * @package App\Http\Controllers\Admin
 */
class PageController extends Controller
{

    /**
     * Manage pages
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.page.manage')
            ->with('pages', Page::all());
    }


    /**
     * Display the form to create the page
     */
    public function create()
    {
        return View::make('admin.page.create');
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

        return Redirect::route('admin.page.edit')
            ->with('page', $page);
    }


    /**
     * Edit a Page / Sections / Blocks
     *
     * @param Page $page
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Page $page)
    {
        $page->load(['sections', 'sections.blocks']);

        return View::make('admin.page.edit')
            ->with('page', $page)
            ->with('plugins', PluginInitialiser::plugins());
    }


    /**
     * Update the page
     *
     * @param UpdatePage $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePage $request, Page $page)
    {
        $page->update($request->all());

        return Redirect::back();
    }


    /**
     * Delete the page
     *
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Page $page)
    {
        $page->delete();

        return Redirect::back();
    }

}
