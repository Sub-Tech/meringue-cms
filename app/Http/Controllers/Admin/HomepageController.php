<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;

/**
 * Class PluginController
 * @package App\Http\Controllers\Admin
 */
class HomepageController extends Controller
{

    /**
     * Render the Modal to edit an Instance of the Plugin
     *
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Page $page)
    {
        $this->removeCurrentHomepageSelection();

        $page->update([
            'homepage' => 1
        ]);

        return redirect()->back();
    }


    /**
     * Turns the current homepage status to 0, ready for the new one
     */
    private function removeCurrentHomepageSelection()
    {
        Page::whereHomepage(1)->update([
            'homepage' => 0
        ]);
    }

}
