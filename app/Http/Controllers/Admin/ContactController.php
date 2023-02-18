<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // iletişim için gelen mesajları listeleme
    public function index()
    {
        // iletişim için gelen mesajları çek
        $suggestion = Contact::orderBy('id', 'desc')->get();
        // iletişim için gelen mesajları view de listele
        return view('backend.contact.index', compact('suggestion'));
    }
}
