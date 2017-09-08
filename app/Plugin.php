<?php

namespace App;

use App\Plugin\PluginInitialiser;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Plugin
 *
 * @property string $class_name
 * @property string $file_name
 * @property string $name
 * @property string|null $description
 * @property string|null $author
 * @property string|null $icon
 * @property int $active
 * @property int $installed
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Block[] $blocks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plugin whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plugin whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plugin whereClassName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plugin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plugin whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plugin whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plugin whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plugin whereInstalled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plugin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plugin whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $vendor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plugin whereVendor($value)
 */
class Plugin extends Model
{
    protected $fillable = [
        'class_name',
        'file_name',
        'active',
        'installed',
        'vendor',
        'name',
        'author',
        'icon',
        'description'
    ];

    protected $primaryKey = 'class_name';

    public $incrementing = false;

    public function getRouteKeyName()
    {
        return 'class_name';
    }

    public function blocks()
    {
        return $this->hasMany(Block::class, 'plugin_class', 'class_name');
    }


    /**
     * Pulls the Plugin Initialiser from the Service Container and initialises the routes
     */
    public static function routes()
    {
        app(PluginInitialiser::class)->initialiseRoutes();
    }


    /**
     * Only return active plugins
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function activePlugins()
    {
        return self::whereActive(1)->get();
    }
}
