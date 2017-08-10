<?php

namespace App;

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
 */
class Section extends Model
{
    protected $fillable = [
        'page_id', 'order', 'background_color', 'foreground_color', 'border_top', 'border_right', 'border_left', 'border_bottom', 'custom_css', 'container', 'active'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page() {
        return $this->belongsTo(Page::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blocks() {
        return $this->hasMany(Block::class);
    }

    public static function render(Section $section) {
        foreach($section->blocks as $block) {
            Block::render($block);
        }
    }

}
