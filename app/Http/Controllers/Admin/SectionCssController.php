<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

/**
 * Class SectionCssController
 * @package App\Http\Controllers\Admin
 */
class SectionCssController extends Controller
{

    /**
     * Update a Section and return if it worked or not
     *
     * @param Request $request
     * @param Section $section
     * @return RedirectResponse
     */
    public function update(Request $request, Section $section)
    {
        $section->update($request->except('custom_css'));

        $section->page->update($request->only('custom_css'));

        return Redirect::back();
    }

    /**
     * Show the modal to alter a Section's Css
     *
     * @param Section $section
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Section $section)
    {
        return View::make('admin.section.modal', [
            'section' => $section,
            'page' => $section->page
        ]);
    }

}
