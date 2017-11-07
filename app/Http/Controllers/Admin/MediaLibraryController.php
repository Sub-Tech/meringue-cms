<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Media;
use Illuminate\Http\Request;

/**
 * Class MediaLibraryController
 * @package App\Http\Controllers\Admin
 */
class MediaLibraryController extends Controller
{

    /**
     * Show the Media Library
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('admin.media', [
            'media' => Media::all()
        ]);
    }

    /**
     * Store a File
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        Media::query()->create([
            'url' => "uploads/" . $request->file('media')->store(''),
        ]);

        return redirect()->route('admin.media');
    }

}
