<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'guest_count' => 'required|integer|min:1'
        ], [
            'date.after_or_equal' => 'Tanggal reservasi tidak boleh sebelum hari ini.',
            'guest_count.min' => 'Jumlah pesanan orang minimal adalah 1 orang.'
        ]);

        $tanggal = \Carbon\Carbon::parse($request->date);
        $waktu = \Carbon\Carbon::createFromFormat('H:i', $request->time);
        $dayOfWeek = $tanggal->dayOfWeek; // 0 = Sunday, 1-5 = Mon-Fri, 6 = Saturday

        if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
            $openTime = \Carbon\Carbon::createFromTime(11, 0);
            $closeTime = \Carbon\Carbon::createFromTime(21, 59);
        } else {
            $openTime = \Carbon\Carbon::createFromTime(11, 0);
            $closeTime = \Carbon\Carbon::createFromTime(22, 59);
        }

        if ($waktu->lessThan($openTime) || $waktu->greaterThanOrEqualTo($closeTime)) {
            return redirect()->back()->withErrors(['time' => 'Cafe belum beroperasional pada jam ini.'])->withInput();
        }

        //total reservasi per orang
        $total = $request->guest_count * 50000;

        Reservation::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'date' => $request->date,
            'time' => $request->time,
            'guest_count' => $request->guest_count,
            'total_price' => $total,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil dibuat!');
    }


}