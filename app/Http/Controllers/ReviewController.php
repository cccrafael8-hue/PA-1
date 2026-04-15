<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    // tampil halaman + semua komentar
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('kritik', compact('reviews'));
    }

    // simpan komentar
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required'
        ]);

        Review::create($request->all());

        return redirect()->back()->with('success', 'Berhasil kirim kritik!');
    }
}