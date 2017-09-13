<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class MenuOption
 *
 * @package App
 * @property int $id
 * @property string $href
 * @property int|null $page
 * @property int|null $parent_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Collection $children
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuOption whereHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuOption wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuOption whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuOption whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuOption whereText($value)
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
     * Custom attribute to append to the base models
     *
     * @var array
     */
    protected $appends = [
        'children'
    ];


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


    /**
     * Get only Parent options
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getParents()
    {
        return self::whereParentId(null)->get();
    }

}
