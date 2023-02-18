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
    // Kullanıcı siteye girer girmez karşısında çalışmasını istediğimiz fonksiyon
    public function index()
    {
        // Veritabanından gerekli verileri çekiyoruz
        $setting = Setting::where('id', 1)->first();
        $social_media = SocialMedia::where('id', 1)->first();
        $menus = Menu::where('status', 1)->where('parent_id', 0)->get();
        // Verileri view'e gönderiyoruz
        return view('index', compact('menus', 'setting', 'social_media'));
    }

    // İletişim formu için gerekli fonksiyon
    public function contact(Request $request)
    {
        // Formdan gelen verileri doğruluyoruz
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $data = $request->except('_token');
        // Verileri veritabanına kaydediyoruz
        Contact::create($data);
        // Kullanıcıyı geri yönlendiriyoruz
        return redirect()->back()->with('success', 'İstek/Şikayetiniz başarıyla gönderildi.');
    }
}
