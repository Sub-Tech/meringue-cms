<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MenuOption;
use App\Page;

/**
 * Class MenuController
 * @package App\Http\Controllers
 */
class MenuController extends Controller
{

    /**
     * Return the Edit Menu page
     */
    public function edit()
    {
        return view('admin.menu.edit')
            ->with('pages', Page::all())
            ->with('parents', MenuOption::getParents());
    }

}
