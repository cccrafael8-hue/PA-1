<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        Contact::create([
            'name' => $request->name,
            'message' => $request->message,
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Pesan berhasil dikirim!');
    }


} 