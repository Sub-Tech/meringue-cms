<?php

namespace Plugins\Meringue\PhotoGallery\Galleries;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;


/**
 * Class Gallery
 * @package Plugins\Meringue\PhotoGallery\Galleries
 */
interface GalleryInterface
{

    /**
     * Render the View for the Gallery
     *
     * @param Collection $images
     * @return View
     */
    public function render(Collection $images);

}