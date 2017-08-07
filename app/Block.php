<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'section_id', 'plugin_class', 'section_id', 'background_color', 'width', 'padding', 'border_top', 'border_right', 'border_left', 'border_bottom', 'custom_css', 'active'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public static function render(Block $block) {
        dd($block);
    }
}
