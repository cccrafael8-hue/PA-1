<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class ReservationController extends Controller
{
    public function create()
    {
        $menus = Menu::all();
        return view('reservasi', compact('menus'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'date' => 'required|date|date_equals:today',
        'time' => 'required',
        'guest_count' => 'required|integer|min:1',
        'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
    ], [
        'date.date_equals' => 'Reservasi hanya bisa dilakukan untuk hari ini.',
        'guest_count.min' => 'Jumlah pesanan orang minimal adalah 1 orang.',
        'payment_proof.required' => 'Bukti pembayaran wajib diunggah.',
        'payment_proof.image' => 'File harus berupa gambar.',
        'payment_proof.mimes' => 'Format gambar yang diperbolehkan hanya jpeg, png, jpg, gif.',
        'payment_proof.max' => 'Ukuran gambar maksimal 5MB.',
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

    if ($waktu->lessThan($openTime) || $waktu->greaterThan($closeTime)) {
        return redirect()->back()->withErrors(['time' => 'Cafe belum beroperasional pada jam ini.'])->withInput();
    }

    if ($tanggal->isToday()) {
        $minimumTime = now()->addMinutes(30);
        $reqDateTime = \Carbon\Carbon::parse($request->date . ' ' . $request->time);
        
        if ($reqDateTime->lessThan($minimumTime)) {
            return redirect()->back()->withErrors(['time' => 'Reservasi harus dibuat minimal 30 menit dari waktu sekarang.'])->withInput();
        }
    }

    // Process menu selection
    $itemsArr = [];
    $total = 0;
    $menusInput = $request->input('menus', []); // array of menu_id => ['qty' => x, 'type' => 'hot'/'cold'/null]

    if (empty($menusInput)) {
        return redirect()->back()->withErrors(['menus' => 'Silakan pilih minimal 1 menu untuk reservasi.'])->withInput();
    }

    $hasItems = false;
    foreach ($menusInput as $menuId => $data) {
        $qty = isset($data['qty']) ? (int) $data['qty'] : 0;
        if ($qty > 0) {
            $hasItems = true;
            $menu = Menu::find($menuId);
            if ($menu) {
                $harga = $menu->price;
                $typeLabel = '';

                if ($menu->category == 'coffee') {
                    $type = isset($data['type']) ? $data['type'] : 'hot'; // default
                    if ($type == 'hot' && $menu->price_hot) {
                        $harga = $menu->price_hot;
                        $typeLabel = ' (Hot)';
                    } elseif ($type == 'cold' && $menu->price_cold) {
                        $harga = $menu->price_cold;
                        $typeLabel = ' (Cold)';
                    }
                }

                $subtotal = $harga * $qty;
                $total += $subtotal;
                
                $itemsArr[] = $menu->name . $typeLabel . " x" . $qty;
            }
        }
    }

    if (!$hasItems) {
        return redirect()->back()->withErrors(['menus' => 'Kuantitas menu tidak boleh kosong. Silakan pilih minimal 1 menu.'])->withInput();
    }

    $itemsStr = implode(', ', $itemsArr);

    $proofPath = null;
    if ($request->hasFile('payment_proof')) {
        $proofPath = $request->file('payment_proof')->store('payments', 'public');
    }

    Reservation::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'date' => $request->date,
        'time' => $request->time,
        'guest_count' => $request->guest_count,
        'items' => $itemsStr,
        'total_price' => $total,
        'status' => 'pending',
        'payment_proof' => $proofPath,
        'note' => $request->note
    ]);

    return redirect()->back()->with('success', 'Reservasi berhasil dibuat! Bukti pembayaran Anda sedang diverifikasi admin.');
    }


}