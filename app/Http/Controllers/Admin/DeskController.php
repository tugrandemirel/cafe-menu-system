<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desk;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    public function index()
    {
        // bana backend klasörü altında desk klavörü altında index.blade.php dosyasını göster. gösterirken ilgili sayfaya desk verisini gönder
        $desks = Desk::orderBy('number', 'asc')->get();
        return view('backend.desk.index', compact('desks'));
    }
    // bana backend klasörü altında desk klavörü altında create.blade.php dosyasını göster
    public function create()
    {
        return view('backend.desk.create');
    }

    // create sayfası içerisinden gelen bilgileri veritabaına kayıt eden fonksiyon
    public function store(Request $request)
    {
        $data = $request->except('_token');
        if ($data['number'] == null || !$data['number'])
            return redirect()->back()->with('error', 'Lütfen masa numarası giriniz');
        if ($data['capacity'] == null || !$data['capacity'])
            return redirect()->back()->with('error', 'Lütfen masa kapasitesi giriniz');

        $data['status'] = (isset($data['status']) && $data['status'] == 'on' ? 1 : 0);
        Desk::create($data);
        return redirect()->route('admin.desk.index')->with('success', 'Masa başarıyla eklendi');
    }

    // masa düzenleme sayfasını getirecek olan fonksiyon
    public function edit(Desk $desk)
    {
        return view('backend.desk.edit', compact('desk'));
    }

    // masa düzenleme sayfasından gelen bilgileri veritabanına kayıt eden fonksiyon
    public function update(Request $request, Desk $desk)
    {
        $data = $request->except('_token');
        if ($data['number'] == null || !$data['number'])
            return redirect()->back()->with('error', 'Lütfen masa numarası giriniz');
        if ($data['capacity'] == null || !$data['capacity'])
            return redirect()->back()->with('error', 'Lütfen masa kapasitesi giriniz');
        $data['status'] = (isset($data['status']) && $data['status'] == 'on' ? 1 : 0);
        $desk->update($data);
        return redirect()->route('admin.desk.index')->with('success', 'Masa başarıyla güncellendi');
    }

    // masa silme fonksiyonu
    public function destroy(Desk $desk)
    {
        $desk->delete();
        return redirect()->route('admin.desk.index')->with('success', 'Masa başarıyla silindi');
    }

}
