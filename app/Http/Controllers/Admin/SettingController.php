<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use ImageHelpers;

class SettingController extends Controller
{
    // ayarlar sayfası
    public function index()
    {
        // ayarlar tablosundan id'si 1 olan veriyi çekiyoruz
        $setting = Setting::where('id', 1)->first();
        // sosyal medya tablosundan id'si 1 olan veriyi çekiyoruz
        $socialmedia = SocialMedia::where('id', 1)->first();
        // verileri view'e gönderiyoruz
        return view('backend.setting.index', compact('setting', 'socialmedia'));
    }


    // ayarlar sayfasında yapılan güncelleme işlemleri
    public function update(Request $request)
    {
        $data = $request->except('_token');
        // ayarlar tablosundan id'si 1 olan veriyi çekiyoruz
        $setting = Setting::where('id', 1)->first();
        $oldLogo = $setting->logo;
        $oldFavicon = $setting->favicon;
        // eğer logo veya favicon seçilmişse
        if ($request->logo) {
            $data['logo'] = ImageHelpers::updateImage($request->file('logo'), 'uploads/setting/', $oldLogo ? $oldLogo : null);
        }
        if ($request->favicon) {
            $data['favicon'] = ImageHelpers::updateImage($request->file('favicon'), 'uploads/setting/', $oldFavicon ? $oldFavicon : null);
        }
        $data['status'] = 1;
        // verileri güncelliyoruz
        $update = Setting::where('id', 1)->update($data);
        if ($update)
        {
            return redirect()->back()->with('success', 'Güncelleme işlemi başarılı bir şekilde gerçekleştirildi');
        }
        else
            return redirect()->back()->with('error', 'Güncelleme işlemi gerçekleştirilemedi');

    }

    // sosyal medya sayfasında yapılan güncelleme işlemleri
    public function socialMediaUpdate(Request $request)
    {
        $data = $request->except('_token');
        // sosyal medya tablosundan id'si 1 olan veriyi güncelliyoruz
        $update = SocialMedia::where('id', 1)->update($data);
        if ($update)
            return redirect()->back()->with('success', 'Güncelleme işlemi başarılı bir şekilde gerçekleştirildi');
        else
            return redirect()->back()->with('error', 'Güncelleme işlemi gerçekleştirilemedi');

    }
}
