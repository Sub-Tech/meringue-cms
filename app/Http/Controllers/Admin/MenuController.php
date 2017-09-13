<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\MenuOption;
use App\Http\Controllers\Controller;

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
