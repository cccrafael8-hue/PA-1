<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('category', 'asc')->get();
        return view('menu', compact('menus'));              // sending data to the view menu.blade.php //
    }
}
