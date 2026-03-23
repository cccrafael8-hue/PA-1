<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        Contact::create([
            'name' => $request->name,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim!');
    }

    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts', compact('contacts'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'Pesan berhasil dihapus');
    }
}