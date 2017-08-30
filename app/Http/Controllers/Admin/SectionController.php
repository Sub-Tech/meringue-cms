<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use App\Section;
use Illuminate\Http\Request;

/**
 * Class SectionController
 * @package App\Http\Controllers\Admin
 */
class SectionController extends Controller
{

    /**
     * Create a new section
     *
     * @param Request $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Page $page)
    {
        $page->sections()->create($request->all());

        return redirect()->back();
    }


    /**
     * Delete a Section
     *
     * @param Section $section
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->back();
    }

}
