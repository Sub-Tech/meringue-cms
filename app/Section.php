<?php

namespace App;

use App\Renderers\SectionRenderer;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Section
 *
 * @property int $id
 * @property int $page_id
 * @property string $order
 * @property string|null $background_color
 * @property string|null $foreground_color
 * @property string|null $border_top
 * @property string|null $border_right
 * @property string|null $border_left
 * @property string|null $border_bottom
 * @property string|null $custom_css
 * @property int $container
 * @property int $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Block[] $blocks
 * @property-read \App\Page $page
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereBorderBottom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereBorderLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereBorderRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereBorderTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereContainer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereCustomCss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereForegroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereUpdatedAt($value)
 * @mixin \Eloquent
 * @package App
 */
class Section extends Model
{

    /**
     * Mass-assignable attributes
     *
     * @var array
     */
    protected $fillable = [
        'page_id',
        'position',
        'background_color',
        'foreground_color',
        'border_top',
        'border_right',
        'border_left',
        'border_bottom',
        'custom_css',
        'container',
        'active'
    ];


    /**
     * Get the Page that this Section belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }


    /**
     * Return all Blocks in this section
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }


    /**
     * Return the number of blocks in this section so that the new position can be applied
     *
     * @return mixed
     */
    public function getHighestPosition()
    {
        return Block::whereSectionId($this->id)->count();
    }


    /**
     * Render the section
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        return SectionRenderer::render($this);
    }


    /**
     * Blocks to come ordered by position by default
     */
    public function getBlocksAttribute()
    {
        return $this->blocks()->orderBy('position')->get();
    }

}
