<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Fungsi untuk USER (Menampilkan Form)
    public function index()
    {
        $reviews = Review::latest()->get();

        return view('kritik', compact('reviews'));
    }

    // Fungsi untuk ADMIN (Menampilkan Tabel)
    public function adminIndex()
    {
        $reviews = Review::latest()->get();
        return view('admin.reviews_admin', compact('reviews'));
    }

    // Fungsi untuk menyimpan kritik dari User
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required'
        ]);

        Review::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengirim kritik!');
    }
}