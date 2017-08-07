<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'user_id', 'meta_description', 'meta_title', 'redirect', 'active'
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
    public function sections() {
        return $this->hasMany(Section::class);
    }
}
