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

    public function show()
    {
        return view('admin.media', [
            'media' => Media::all()
        ]);
    }

    public function create(Request $request)
    {
        $path = $request->file('media')->store('');

        Media::query()->create([
            'path' => $path,
        ]);

        return redirect()->route('admin.media');
    }

}
