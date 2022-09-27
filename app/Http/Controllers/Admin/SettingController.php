<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use ImageHelpers;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        $socialmedia = SocialMedia::where('id', 1)->first();
        return view('backend.setting.index', compact('setting', 'socialmedia'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');
        $setting = Setting::where('id', 1)->first();
        $oldLogo = $setting->logo;
        $oldFavicon = $setting->favicon;
        if ($request->logo) {
            $data['logo'] = ImageHelpers::updateImage($request->file('logo'), 'uploads/setting/', $oldLogo ? $oldLogo : null);
        }
        if ($request->favicon) {
            $data['favicon'] = ImageHelpers::updateImage($request->file('favicon'), 'uploads/setting/', $oldFavicon ? $oldFavicon : null);
        }
        $data['status'] = 1;
        $update = Setting::where('id', 1)->update($data);
        if ($update)
        {
            return redirect()->back()->with('success', 'Güncelleme işlemi başarılı bir şekilde gerçekleştirildi');
        }
        else
            return redirect()->back()->with('error', 'Güncelleme işlemi gerçekleştirilemedi');

    }

    public function socialMediaUpdate(Request $request)
    {
        $data = $request->except('_token');
        $update = SocialMedia::where('id', 1)->update($data);
        if ($update)
            return redirect()->back()->with('success', 'Güncelleme işlemi başarılı bir şekilde gerçekleştirildi');
        else
            return redirect()->back()->with('error', 'Güncelleme işlemi gerçekleştirilemedi');

    }
}
