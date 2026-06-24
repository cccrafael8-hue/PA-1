<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('album')->latest()->get();
        $albums = Album::latest()->get();
        return view('admin.gallery_admin', compact('galleries', 'albums'));
    }

    public function storeAlbum(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Album::create(['name' => $request->name]);
        return back()->with('success', 'Album berhasil ditambahkan');
    }

    public function deleteAlbum($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();
        return back()->with('success', 'Album berhasil dihapus');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable',
            'album_id' => 'required|exists:albums,id',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'album_id' => $request->album_id,
            'image' => $imagePath,
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Berhasil ditambah');
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string',
            'album_id' => 'required|exists:albums,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            $imagePath = $request->file('image')->store('gallery', 'public');
            $gallery->image = $imagePath;
        }

        $gallery->title = $request->title;
        $gallery->album_id = $request->album_id;
        $gallery->save();

        return back()->with('success', 'Berhasil diupdate');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return back()->with('success', 'Berhasil dihapus');
    }
}