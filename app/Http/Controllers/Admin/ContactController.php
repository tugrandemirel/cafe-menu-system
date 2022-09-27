<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $suggestion = Contact::orderBy('id', 'desc')->get();
        return view('backend.contact.index', compact('suggestion'));
    }
}
