<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

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
}