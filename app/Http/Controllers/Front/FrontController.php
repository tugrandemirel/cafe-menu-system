<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        $social_media = SocialMedia::where('id', 1)->first();
        $menus = Menu::where('status', 1)->where('parent_id', 0)->get();
        return view('index', compact('menus', 'setting', 'social_media'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $data = $request->except('_token');
        Contact::create($data);
        return redirect()->back()->with('success', 'İstek/Şikayetiniz başarıyla gönderildi.');
    }
}
