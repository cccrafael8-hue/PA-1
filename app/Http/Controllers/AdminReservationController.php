<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    // ADMIN LIHAT 
    public function index()
    {
        $reservations = Reservation::latest()->get();
        return view('admin.reservasi', compact('reservations'));
    }

    // ADMIN UPDATE STATUS
    public function updateStatus($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'paid';
        $reservation->save();

        return back();
    }

    // ADMIN CANCEL
    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'cancelled';
        $reservation->save();

        return back()->with('success', 'Reservasi berhasil dibatalkan.');
    }

    // ADMIN DELETE
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->status == 'pending') {
            return back()->with('error', 'Reservasi yang masih pending tidak dapat dihapus. Silakan batalkan terlebih dahulu.');
        }

        $reservation->delete();
        return back()->with('success', 'Reservasi berhasil dihapus.');
    }
}
