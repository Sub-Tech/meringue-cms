<?php

namespace App\Helpers;

use App\MenuOption;

/**
 * Class MenuRenderer
 * @package App\Renderers
 */
class MenuBuilder
{

    /**
     * The Array of Menu Options
     *
     * @var MenuOption[]
     */
    private $menuOptions = [];


    /**
     * Render the
     *
     * @return MenuOption[]
     */
    public function build(): ?array
    {
        $this->constructKeyValueArray();

        foreach ($this->menuOptions as $menuOption) {
            if ($menuOption->isParent()) {
                continue;
            }

            $this->insertOptionIntoParentsChildrenArray($menuOption);

            $this->removeOptionFromMainArray($menuOption);
        }

        return $this->menuOptions;
    }


    /**
     * Constructs an array where the id of the MenuOption is the key
     * This will make it easier to manipulate the array
     */
    private function constructKeyValueArray()
    {
        foreach (MenuOption::all() as $menuOption) {
            $this->menuOptions[$menuOption->id] = $menuOption;
        }
    }


    /**
     * Inserts the MenuOption into its Parent's 'children' array
     *
     * @param MenuOption $menuOption
     */
    private function insertOptionIntoParentsChildrenArray(MenuOption $menuOption)
    {
        $parent =& $this->menuOptions[$menuOption->parent_id];

        $parent->children[] = $menuOption;
    }


    /**
     * Remove the Child MenuOption from its position amongst the Parents
     *
     * @param MenuOption $menuOption
     */
    private function removeOptionFromMainArray(MenuOption $menuOption)
    {
        unset($this->menuOptions[$menuOption->id]);
    }

}