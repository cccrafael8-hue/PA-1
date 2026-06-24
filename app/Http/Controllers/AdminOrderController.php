<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{

    public function index()
    {
        $activeOrders = Order::where('is_hidden', false)->whereNotIn('status', ['selesai', 'batal'])->latest()->get();
        $archivedOrders = Order::where('is_hidden', false)->whereIn('status', ['selesai', 'batal'])->latest()->get();

        return view('admin.order_admin', compact('activeOrders', 'archivedOrders'));
    }



    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,batal'
        ]);

        $order = Order::findOrFail($id);

        if (in_array($order->status, ['selesai', 'batal'])) {
            return back()->with('error', 'Status pesanan yang sudah arsip (Selesai/Batal) tidak dapat diubah lagi');
        }

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }


}