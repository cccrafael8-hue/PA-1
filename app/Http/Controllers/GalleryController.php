<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Album;

class GalleryController extends Controller
{
    public function index()
    {
        // Get all albums and load only the latest photo for each album as cover
        $albums = Album::with(['galleries' => function($q) {
            $q->latest()->limit(1);
        }])->withCount('galleries')->get();

        return view('gallery', compact('albums'));
    }

    public function show($id)
    {
        $album = Album::findOrFail($id);
        $galleries = Gallery::where('album_id', $id)->latest()->paginate(10);
        
        return view('gallery_album', compact('album', 'galleries'));
    }
}
