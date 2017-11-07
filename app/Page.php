<?php

namespace App;

use App\Renderers\PageRenderer;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Page
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $slug
 * @property string|null $meta_description
 * @property string|null $meta_title
 * @property string|null $custom_css
 * @property string|null $redirect
 * @property int $active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Section[] $sections
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereCustomCss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereRedirect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereUserId($value)
 * @mixin \Eloquent
 * @property int $homepage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereHomepage($value)
 */
class Page extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'meta_description',
        'meta_title',
        'redirect',
        'custom_css',
        'active',
        'homepage'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }


    /**
     * Sections to come ordered by position by default
     */
    public function getSectionsAttribute()
    {
        return $this->sections()->orderBy('position')->get();
    }


    /**
     * Render the page by its slug
     *
     * @param string $slug
     * @return mixed
     */
    public static function render(string $slug)
    {
        $page = self::whereSlug($slug)->firstOrFail();

        return PageRenderer::render($page);
    }
}
