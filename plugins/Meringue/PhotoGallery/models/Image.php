<?php

namespace Plugins\Meringue\PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * @package Plugins\Meringue\PhotoGallery\Models
 */
class Image extends Model
{

    protected $table = "meringue_photogallery_images";

    protected $fillable = [
        'url',
        'gallery_id'
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

}