<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMenuOption;
use App\Http\Requests\UpdateMenuOption;
use App\MenuOption;
use Illuminate\Support\Facades\Redirect;

/**
 * Class MenuOptionsController
 * @package App\Http\Controllers
 */
class MenuOptionController extends Controller
{

    /**
     * Create a new Menu Option
     *
     * @param CreateMenuOption $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateMenuOption $request)
    {
        MenuOption::create($request->all());

        return Redirect::back();
    }


    /**
     * Update the Menu Option
     *
     * @param UpdateMenuOption $request
     * @param MenuOption $menuOption
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMenuOption $request, MenuOption $menuOption)
    {
        $menuOption->update($request->all());

        return Redirect::back();
    }


    /**
     * Delete the Menu Option
     *
     * @param MenuOption $menuOption
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MenuOption $menuOption)
    {
        if ($menuOption->isParent()) {
            $menuOption->children->each->delete();
        }

        $menuOption->delete();

        return Redirect::back();
    }

}
