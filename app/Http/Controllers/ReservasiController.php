<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu' => 'required',
            'jumlah_orang' => 'required|integer|min:1'
        ], [
            'tanggal.after_or_equal' => 'Tanggal reservasi tidak boleh sebelum hari ini.',
            'jumlah_orang.min' => 'Jumlah pesanan orang minimal adalah 1 orang.'
        ]);

        $tanggal = \Carbon\Carbon::parse($request->tanggal);
        $waktu = \Carbon\Carbon::createFromFormat('H:i', $request->waktu);
        $dayOfWeek = $tanggal->dayOfWeek; // 0 = Sunday, 1-5 = Mon-Fri, 6 = Saturday

        if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
            $openTime = \Carbon\Carbon::createFromTime(11, 0);
            $closeTime = \Carbon\Carbon::createFromTime(21, 59);
        } else {
            $openTime = \Carbon\Carbon::createFromTime(11, 0);
            $closeTime = \Carbon\Carbon::createFromTime(22, 59);
        }

        if ($waktu->lessThan($openTime) || $waktu->greaterThanOrEqualTo($closeTime)) {
            return redirect()->back()->withErrors(['waktu' => 'Cafe belum beroperasional pada jam ini.'])->withInput();
        }

        //total reservasi per orang
        $total = $request->jumlah_orang * 50000;

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
        Reservasi::destroy($id);
        return back();
    }
}