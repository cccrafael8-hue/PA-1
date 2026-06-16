<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\Menu;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Akun tersebut belum terdaftar',
            ]);
        }

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            // User biasa
            return redirect('/welcome');
        }

        return back()->withErrors([
            'email' => 'Password yang Anda masukkan salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function welcome()
    {
        $latestGallery = Gallery::latest()->first();

        // Cari menu paling populer dari Orders dalam 7 hari terakhir
        $orders = Order::where('created_at', '>=', now()->subDays(7))->get();
        
        // Jika tidak ada pesanan minggu ini, ambil dari semua pesanan sebagai fallback
        if ($orders->isEmpty()) {
            $orders = Order::all();
        }
        $menuCounts = [];
        foreach($orders as $order) {
            $items = explode(', ', $order->menu);
            foreach($items as $item) {
                if(trim($item) == '') continue;
                $parts = explode(' x', $item);
                if(count($parts) == 2) {
                    $name = trim($parts[0]);
                    $qty = (int)$parts[1];
                    if(!isset($menuCounts[$name])) {
                        $menuCounts[$name] = 0;
                    }
                    $menuCounts[$name] += $qty;
                }
            }
        }
        
        $popularMenu = null;
        if(!empty($menuCounts)) {
            arsort($menuCounts);
            $popularName = array_key_first($menuCounts);
            $popularMenu = Menu::where('nama_menu', $popularName)->first();
        }

        // Kalau tidak ada order atau menu tidak ditemukan, tampilkan menu pertama
        if(!$popularMenu) {
            $popularMenu = Menu::first();
        }

        // Calculate average rating from Review model
        $averageRating = \App\Models\Review::avg('rating') ?? 0;
        // Round to 1 decimal place, e.g., 4.5
        $averageRating = round($averageRating, 1);

        return view('welcome', compact('latestGallery', 'popularMenu', 'averageRating'));
    }
}