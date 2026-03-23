<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{

    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.order_admin', compact('orders'));
    }

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

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Pesanan berhasil dihapus');
    }

}