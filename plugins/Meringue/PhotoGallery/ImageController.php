<?php

namespace Plugins\Meringue\PhotoGallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Plugins\Meringue\PhotoGallery\Models\Gallery;
use Plugins\Meringue\PhotoGallery\Models\Image;

/**
 * Class ImageController
 * @package Plugins\Meringue\PhotoGallery
 */
class ImageController extends Controller
{

    /**
     * Attach a new Image to a Gallery
     *
     * @param Request $request
     * @param Gallery $gallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request, Gallery $gallery)
    {
        $gallery->images()->create($request->all());

        return redirect()->route('PhotoGallery.edit', [
            'gallery' => $gallery
        ]);
    }


    /**
     * Remove an Image from a Gallery
     *
     * @param Gallery $gallery
     * @param Image $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Gallery $gallery, Image $image)
    {
        $image->delete();

        return redirect()->route('PhotoGallery.edit', [
            'gallery' => $gallery
        ]);
    }

}