<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class MenuOption
 * @package App
 */
class MenuOption extends Model
{

    /**
     * Guarded attributes
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Return whether or not this Option is a Parent
     *
     * @return bool
     */
    public function isParent(): bool
    {
        return $this->parent_id == null;
    }


    /**
     * Delete all children of this Option
     *
     * @return Collection
     */
    public function getChildrenAttribute(): Collection
    {
        return MenuOption::whereParentId($this->id)->get();
    }

}
