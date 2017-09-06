<?php

namespace Plugins\Meringue\Image\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'meringue_image_images';

    protected $fillable = [
        'url',
        'alt'
    ];
}