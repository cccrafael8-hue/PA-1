<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;

class AdminController extends Controller
{
    public function dashboard()
    {
        $reservasis = Reservasi::all();

        return view('admin.dashboard', compact('reservasis'));
    }
}