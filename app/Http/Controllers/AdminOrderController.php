<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('is_hidden', false)->latest()->get();

        return view('admin.order_admin', compact('orders'));
    }



    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['is_hidden' => true]);

        return back()->with('success', 'Pesanan berhasil dihapus');
    }

}