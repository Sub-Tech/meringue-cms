<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BlockRegistry
 *
 * @property string $plugin_class
 * @property string $name
 * @property string $description
 * @property string|null $icon
 * @property string|null $inputs
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Plugin $plugin
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BlockRegistry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BlockRegistry whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BlockRegistry whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BlockRegistry whereInputs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BlockRegistry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BlockRegistry wherePluginClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BlockRegistry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BlockRegistry extends Model
{
    protected $fillable = [
        'plugin_class', 'name', 'description', 'icon', 'inputs'
    ];

    protected $primaryKey = 'plugin_class';

    public $incrementing = false;

    public function plugin()
    {
        return $this->belongsTo(Plugin::class, 'plugin_name', 'class_name');
    }

}
