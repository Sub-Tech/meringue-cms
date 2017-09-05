<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

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
     * @return RedirectResponse
     */
    public function update(Page $page)
    {
        $this->removeCurrentHomepageSelection();

        $page->update([
            'homepage' => 1
        ]);

        return Redirect::back();
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
