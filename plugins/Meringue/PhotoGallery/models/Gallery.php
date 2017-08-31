<?php

namespace Plugins\Meringue\PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gallery
 * @package Plugins\Meringue\PhotoGallery\Models
 */
class Gallery extends Model
{

    protected $table = "meringue_photogallery_galleries";

    protected $fillable = [
        'class',
        'name'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}