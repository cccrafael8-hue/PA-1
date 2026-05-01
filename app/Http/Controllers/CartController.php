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
                        ->first();

        if($item){
            $item->qty += 1;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'menu_id' => $request->menu_id,
                'qty' => 1
            ]);
        }

        return back()->with('success', 'Menu berhasil ditambah ke keranjang');
    }

    public function update(Request $request)
    {
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

    $cart = $this->getCart()->load('items.menu');

    $total = 0;
    $menuList = "";

    foreach($cart->items as $item){
        $subtotal = $item->menu->harga * $item->qty;
        $total += $subtotal;

        $menuList .= $item->menu->nama_menu . " x" . $item->qty . ", ";
    }

    Order::create([
        'user_id' => auth()->id(),
        'nama' => auth()->user()->name,
        'menu' => $menuList,
        'total' => $total,
        'status' => 'Pending',
        'note' => $request->note
    ]);

    CartItem::where('cart_id', $cart->id)->delete();

    return back()->with('success', 'Pesanan Berhasil Dibuat');
}
}
