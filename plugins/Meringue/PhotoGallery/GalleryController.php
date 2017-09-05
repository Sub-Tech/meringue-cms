<?php

namespace Plugins\Meringue\PhotoGallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Plugins\Meringue\PhotoGallery\Models\Gallery;

/**
 * Class GalleryController
 * @package Plugins\Meringue\PhotoGallery
 */
class GalleryController extends Controller
{

    use GalleryTypes;

    /**
     * @return View
     */
    public function index()
    {
        return view('Meringue.PhotoGallery.views.gallery.index')
            ->with('galleries', Gallery::all());
    }


    /**
     * @param Gallery $gallery
     * @return View
     */
    public function show(Gallery $gallery)
    {
//        return view('Meringue.PhotoGallery.views.gallery.show')
//            ->with('gallery', $gallery);

        return null;
    }


    /**
     *
     */
    public function create()
    {
        return view('Meringue.PhotoGallery.views.gallery.create')
            ->with('galleryTypes', $this->getGalleryTypes());
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        return redirect()->route('PhotoGallery.edit', [
            'gallery' => Gallery::create($request->all())
        ]);
    }


    /**
     * @param Gallery $gallery
     * @return $this
     */
    public function edit(Gallery $gallery)
    {
        return view('Meringue.PhotoGallery.views.gallery.edit')
            ->with('gallery', $gallery);
    }


    /**
     * @param Request $request
     * @param Gallery $gallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Gallery $gallery)
    {
        return redirect()->route('PhotoGallery.edit', [
            'gallery' => $gallery->update($request->all())
        ]);
    }


    /**
     * @param Gallery $gallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('PhotoGallery.index');
    }

}