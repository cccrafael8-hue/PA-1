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
        $data = $request->validate([
            'nama_menu'=>'required',
            'kategori'=>'required|in:makanan,coffee,non_coffee',
            'deskripsi'=>'required',
            'harga'=>'required',
            'gambar'=>'nullable|image'
        ]);

        if($request->file('gambar')){
            $data['gambar'] = $request->file('gambar')->store('menu','public');
        }

        Menu::create($data);

        return redirect('/admin/menu')->with('success', 'Menu berhasil ditambahkan');
    }

    // =========================
    // 🔥 TAMBAHAN MULAI SINI
    // =========================

    // EDIT
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $menus = Menu::all();

        return view('admin.menu_admin', compact('menu','menus'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $data = $request->validate([
            'nama_menu'=>'required',
            'kategori'=>'required|in:makanan,coffee,non_coffee',
            'deskripsi'=>'required',
            'harga'=>'required',
            'gambar'=>'nullable|image'
        ]);

        if($request->file('gambar')){
            // hapus gambar lama
            if($menu->gambar){
                Storage::disk('public')->delete($menu->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('menu','public');
        }

        $menu->update($data);

        return redirect('/admin/menu')->with('success', 'Menu berhasil diupdate');
    }

    // DELETE
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