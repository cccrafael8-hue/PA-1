<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Order;

class CartController extends Controller
{
    private function getCart()
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if(!$cart){
            $cart = Cart::create([
                'user_id' => auth()->id()
            ]);
        }
        return $cart;
    }

    public function index()
    {
        $cart = $this->getCart()->load('items.menu');
        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $cart = $this->getCart();

        $item = CartItem::where('cart_id', $cart->id)
                        ->where('menu_id', $request->menu_id)
                        ->where('type', $request->type)
                        ->first();

        if($item){
            $item->qty += 1;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'menu_id' => $request->menu_id,
                'qty' => 1,
                'type' => $request->type,
                'user_id' => auth()->id()
            ]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            $cartCount = $cart->items()->sum('qty');
            return response()->json([
                'success' => true, 
                'message' => 'Menu berhasil ditambah ke keranjang', 
                'cartCount' => $cartCount
            ]);
        }

        return back()->with('success', 'Menu berhasil ditambah ke keranjang');
    }

    public function update(Request $request)
    {
        if ($request->qty < 1) {
            return back()->with('error', 'Minimal pesanan adalah 1. Jika ingin membatalkan, silakan klik Hapus.');
        }

        $item = CartItem::find($request->id);
        $item->qty = $request->qty;
        $item->save();

        return back()->with('success', 'Menu berhasil diupdate');
    }

    public function remove(Request $request)
    {
        CartItem::destroy($request->id);
        return back()->with('success', 'Menu berhasil dihapus');
    }

    public function checkout(Request $request) {

    $request->validate([
        'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
    ], [
        'payment_proof.required' => 'Bukti pembayaran wajib diunggah.',
        'payment_proof.image' => 'File harus berupa gambar.',
        'payment_proof.mimes' => 'Format gambar yang diperbolehkan hanya jpeg, png, jpg, gif.',
        'payment_proof.max' => 'Ukuran gambar maksimal 5MB.',
    ]);

    $cart = $this->getCart()->load('items.menu');

    if ($cart->items->count() === 0) {
        return back()->with('error', 'Keranjang belanja Anda masih kosong. Silakan tambahkan menu terlebih dahulu sebelum memesan.');
    }

    $total = 0;
    $menuList = "";

    foreach($cart->items as $item){
        $harga = $item->menu->price;
        if($item->menu->category == 'coffee') {
            if($item->type == 'hot' && $item->menu->price_hot) $harga = $item->menu->price_hot;
            if($item->type == 'cold' && $item->menu->price_cold) $harga = $item->menu->price_cold;
        }

        $subtotal = $harga * $item->qty;
        $total += $subtotal;

        $tipeLabel = $item->type ? ' ('.ucfirst($item->type).')' : '';
        $menuList .= $item->menu->name . $tipeLabel . " x" . $item->qty . ", ";
    }

    $proofPath = null;
    if ($request->hasFile('payment_proof')) {
        $proofPath = $request->file('payment_proof')->store('payments', 'public');
    }

    Order::create([
        'user_id' => auth()->id(),
        'name' => auth()->user()->name,
        'items' => rtrim($menuList, ", "),
        'total' => $total,
        'status' => 'Pending',
        'note' => $request->note,
        'payment_proof' => $proofPath
    ]);

    CartItem::where('cart_id', $cart->id)->delete();

    return back()->with('success', 'Pesanan Berhasil Dibuat');
}
}
