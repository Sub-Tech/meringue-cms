<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Block
 *
 * @property int $id
 * @property int $section_id
 * @property string $plugin_class
 * @property string $order
 * @property string|null $background_color
 * @property string|null $width
 * @property string|null $padding
 * @property string|null $border_top
 * @property string|null $border_right
 * @property string|null $border_left
 * @property string|null $border_bottom
 * @property string|null $custom_css
 * @property int $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\BlockRegistry $blockRegistry
 * @property-read \App\Plugin $plugin
 * @property-read \App\Section $section
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereBorderBottom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereBorderLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereBorderRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereBorderTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereCustomCss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block wherePadding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block wherePluginClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereWidth($value)
 * @mixin \Eloquent
 */
class Block extends Model
{
    protected $fillable = [
        'section_id',
        'plugin_class',
        'background_color',
        'width',
        'padding',
        'border_top',
        'border_right',
        'border_left',
        'border_bottom',
        'custom_css',
        'active',
        'instance_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function plugin()
    {
        return $this->hasOne(Plugin::class, 'class_name', 'plugin_class');
    }

    public function blockRegistry()
    {
        return $this->hasOne(BlockRegistry::class, 'plugin_class', 'plugin_class');
    }

}
