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

    // Fungsi untuk ADMIN (Membalas Review)
    public function reply(Request $request, $id)
    {
        $request->validate([
            'admin_reply' => 'required'
        ]);

        $review = Review::findOrFail($id);
        $review->update([
            'admin_reply' => $request->admin_reply
        ]);

        return redirect()->back()->with('success', 'Berhasil membalas pesan user!');
    }

    // Fungsi untuk Menghapus Review (User)
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Review berhasil dihapus!');
    }

    // Fungsi untuk Menghapus Balasan Admin
    public function deleteReply($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['admin_reply' => null]);

        return redirect()->back()->with('success', 'Balasan berhasil dihapus!');
    }
}