<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class AdminReviewController extends Controller
{
    // Fungsi untuk ADMIN (Menampilkan Tabel)
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('admin.reviews_admin', compact('reviews'));
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

    // Fungsi untuk ADMIN (Menghapus Review)
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
