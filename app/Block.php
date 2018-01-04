<?php

namespace App;

use App\Facades\PluginInitialiser;
use App\Renderers\BlockRenderer;
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
 * @property-read \App\Section $section
 * @property-read \App\Plugin $plugin
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
 * @property int|null $instance_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Block whereInstanceId($value)
 */
class Block extends Model
{

    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = [
        'section_id',
        'plugin_class',
        'background_color',
        'position',
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
     * Return the Section that the Block belongs to
     *
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

    /**
     * @param bool $withContainer
     * @return string
     */
    public function render($withContainer = true)
    {
        return BlockRenderer::render($this, $withContainer);
    }


    /**
     * Checks the plugins array for inactive plugins
     * @return bool
     */
    public function isTryingToRenderAnInactivePlugin()
    {
        return !PluginInitialiser::plugins()->has($this->plugin_class);
    }


    /**
     * Checks to see whether the Plugin being rendered has any dependencies
     * If it does and the dependency is unavailable, render nothing
     *
     * @return bool
     */
    public function pluginDependsOnAnInactivePlugin()
    {
        /** @var Block $this */
        if (isset($this->plugin->requires)) {
            try {
                $this->plugin->requires($this->plugin->requires);
            } catch (\Exception $exception) {
                return true;
            }
        }

        return false;
    }

}
