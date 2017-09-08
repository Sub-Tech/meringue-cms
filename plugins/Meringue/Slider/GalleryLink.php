<?php

namespace Plugins\Meringue\Slider;

use Illuminate\Database\Eloquent\Model;
use Plugins\Meringue\PhotoGallery\Models\Gallery;

/**
 * Class GalleryLink
 * @package Plugins\Meringue\Slider
 */
class GalleryLink extends Model
{
    protected $guarded = [];

    protected $table = 'meringue_slider_sliders';

    public function mainGallery()
    {
        return Gallery::findOrFail($this->main_gallery_id);
    }

    public function navigationGallery()
    {
        return Gallery::findOrFail($this->nav_gallery_id);
    }
}