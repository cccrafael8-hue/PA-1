<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        Order::create([
            'nama' => $request->nama,
            'menu' => $request->menu,
            'total' => $request->total,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success','Pesanan berhasil dibuat');
    }
}
