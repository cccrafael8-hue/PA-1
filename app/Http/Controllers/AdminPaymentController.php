<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $qrCode = Setting::where('key', 'qr_code_payment')->first();
        return view('admin.payment_settings', compact('qrCode'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'qr_code.required' => 'Gambar QR Code wajib diunggah.',
            'qr_code.image' => 'File harus berupa gambar.',
            'qr_code.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg.',
            'qr_code.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $setting = Setting::firstOrCreate(['key' => 'qr_code_payment']);

        if ($request->hasFile('qr_code')) {
            if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }
            $path = $request->file('qr_code')->store('payments', 'public');
            $setting->value = $path;
            $setting->save();
        }

        return back()->with('success', 'QR Code Pembayaran berhasil diperbarui!');
    }
}
