<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menu_admin', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu_admin');
    }

    public function store(Request $request)
    {
        // Teks pesan error kustom dalam Bahasa Indonesia jika validasi gagal
        $messages = [
            'price.min'      => 'Harga minimal Rp1.000.',
            'price.max'      => 'Harga maksimal Rp1.000.000.',  
            'price_hot.min'  => 'Harga Hot minimal Rp1.000.',
            'price_hot.max'  => 'Harga Hot maksimal Rp1.000.000.', 
            'price_cold.min' => 'Harga Cold minimal Rp1.000.',
            'price_cold.max' => 'Harga Cold maksimal Rp1.000.000.',  
        ];

        // Validasi ketat di sisi server (Backend)
        $data = $request->validate([
            'name'  => 'required',
            'category'   => 'required|in:makanan,coffee,non_coffee,snack',
            'description'  => 'required',
            'price'      => 'required|numeric|min:1000|max:1000000',  
            'price_hot'  => 'nullable|numeric|min:1000|max:1000000', 
            'price_cold' => 'nullable|numeric|min:1000|max:1000000',  
            'image'     => 'nullable|image'
        ], $messages);

        if($request->file('image')){
            $data['image'] = $request->file('image')->store('menu','public');
        }

        $data['user_id'] = Auth::id();

        Menu::create($data);

        return redirect('/admin/menu')->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $menus = Menu::all();

        return view('admin.menu_admin', compact('menu','menus'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        // Teks pesan error kustom dalam Bahasa Indonesia jika validasi gagal
        $messages = [
            'price.min'      => 'Harga minimal Rp1.000.',
            'price.max'      => 'Harga maksimal Rp1.000.000.',     
            'price_hot.min'  => 'Harga Hot minimal Rp1.000.',
            'price_hot.max'  => 'Harga Hot maksimal Rp1.000.000.',   
            'price_cold.min' => 'Harga Cold minimal Rp1.000.',
            'price_cold.max' => 'Harga Cold maksimal Rp1.000.000.', 
        ];

        // Validasi ketat di sisi server (Backend)
        $data = $request->validate([
            'name'  => 'required',
            'category'   => 'required|in:makanan,coffee,non_coffee,snack',
            'description'  => 'required',
            'price'      => 'required|numeric|min:1000|max:1000000', 
            'price_hot'  => 'nullable|numeric|min:1000|max:1000000',
            'price_cold' => 'nullable|numeric|min:1000|max:1000000', 
            'image'     => 'nullable|image'
        ], $messages);

        if($request->file('image')){
            if($menu->image){
                Storage::disk('public')->delete($menu->image);
            }

            $data['image'] = $request->file('image')->store('menu','public');
        }

        $menu->update($data);

        return redirect('/admin/menu')->with('success', 'Menu berhasil diupdate');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if($menu->image){
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect('/admin/menu')->with('success', 'Menu berhasil dihapus');
    }
}