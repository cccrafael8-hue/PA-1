<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    // USER BUAT RESERVASI
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'jumlah_orang' => 'required|integer'
        ]);

        $total = $request->jumlah_orang * 50000; // 50rb per orang

        Reservasi::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'jumlah_orang' => $request->jumlah_orang,
            'total_bayar' => $total,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil dibuat!');
    }

    // ADMIN LIHAT SEMUA
    public function index()
    {
        $reservasis = Reservasi::latest()->get();
        return view('admin.reservasi', compact('reservasis'));
    }

    // ADMIN UPDATE STATUS
    public function updateStatus($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->status = 'paid';
        $reservasi->save();

        return back();
    }

    // ADMIN DELETE
    public function destroy($id)
    {
        Reservasi::destroy($id);
        return back();
    }
}