<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
