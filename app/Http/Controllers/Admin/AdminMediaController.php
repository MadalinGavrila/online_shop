<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use App\Http\Controllers\Controller;

class AdminMediaController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')->paginate(8);

        return view('admin.media.index', compact('photos'));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('delete photos')){
            $photo = Photo::findOrFail($id);

            unlink(public_path() . $photo->path);

            $photo->delete();

            return redirect()->route('admin.media.index')->withSuccess('Photo has been deleted !');
        }

        return redirect()->back();
    }
}
