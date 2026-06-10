<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class AdminReservasiController extends Controller
{
    // ADMIN LIHAT 
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
        $reservasi = Reservasi::findOrFail($id);

        if ($reservasi->status != 'paid') {
            return back()->with('error', 'Reservasi yang belum dibayar tidak dapat dihapus.');
        }

        $reservasi->delete();
        return back()->with('success', 'Reservasi berhasil dihapus.');
    }
}
