<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

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
            'harga.min'      => 'Harga minimal Rp1.000.',
            'harga.max'      => 'Harga maksimal Rp1.000.000.',  
            'harga_hot.min'  => 'Harga Hot minimal Rp1.000.',
            'harga_hot.max'  => 'Harga Hot maksimal Rp1.000.000.', 
            'harga_cold.min' => 'Harga Cold minimal Rp1.000.',
            'harga_cold.max' => 'Harga Cold maksimal Rp1.000.000.',  
        ];

        // Validasi ketat di sisi server (Backend)
        $data = $request->validate([
            'nama_menu'  => 'required',
            'kategori'   => 'required|in:makanan,coffee,non_coffee,snack',
            'deskripsi'  => 'required',
            'harga'      => 'required|numeric|min:1000|max:1000000',  
            'harga_hot'  => 'nullable|numeric|min:1000|max:1000000', 
            'harga_cold' => 'nullable|numeric|min:1000|max:1000000',  
            'gambar'     => 'nullable|image'
        ], $messages);

        if($request->file('gambar')){
            $data['gambar'] = $request->file('gambar')->store('menu','public');
        }

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
            'harga.min'      => 'Harga minimal Rp1.000.',
            'harga.max'      => 'Harga maksimal Rp1.000.000.',     
            'harga_hot.min'  => 'Harga Hot minimal Rp1.000.',
            'harga_hot.max'  => 'Harga Hot maksimal Rp1.000.000.',   
            'harga_cold.min' => 'Harga Cold minimal Rp1.000.',
            'harga_cold.max' => 'Harga Cold maksimal Rp1.000.000.', 
        ];

        // Validasi ketat di sisi server (Backend)
        $data = $request->validate([
            'nama_menu'  => 'required',
            'kategori'   => 'required|in:makanan,coffee,non_coffee,snack',
            'deskripsi'  => 'required',
            'harga'      => 'required|numeric|min:1000|max:1000000', 
            'harga_hot'  => 'nullable|numeric|min:1000|max:1000000',
            'harga_cold' => 'nullable|numeric|min:1000|max:1000000', 
            'gambar'     => 'nullable|image'
        ], $messages);

        if($request->file('gambar')){
            if($menu->gambar){
                Storage::disk('public')->delete($menu->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('menu','public');
        }

        $menu->update($data);

        return redirect('/admin/menu')->with('success', 'Menu berhasil diupdate');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if($menu->gambar){
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect('/admin/menu')->with('success', 'Menu berhasil dihapus');
    }
}