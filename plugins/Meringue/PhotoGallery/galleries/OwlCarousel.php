<?php

namespace Plugins\Meringue\PhotoGallery\Galleries;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\{
    View
};

/**
 * Class Isotope
 * @package Plugins\Meringue\PhotoGallery\Galleries
 */
class OwlCarousel implements GalleryInterface
{

    /**
     * Render the View for the Gallery
     *
     * @param Collection $images
     * @return View
     */
    public function render(Collection $images)
    {
        return view('Meringue.PhotoGallery.views.owlcarousel')
            ->with('images', $images);
    }

}