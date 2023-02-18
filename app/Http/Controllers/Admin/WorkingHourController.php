<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkingHour;
use Illuminate\Http\Request;

class WorkingHourController extends Controller
{
    // Bütün çalışma saatlerini listeler
    public function index()
    {
        // WorkingHour modelinden tüm kayıtları getirir
        $workingHours = WorkingHour::all();
        return view('backend.workingHour.index', compact('workingHours'));
    }
    // Yeni çalışma saatini ekle sayfasına yönlendirir
    public function create()
    {
       return view('backend.workingHour.create');
    }
    // Yeni çalışma saatini kaydeder
    public function store(Request $request)
    {
        // gelen verileri filtreler
        $request->validate([
            'hour' => 'required',
            'day' => 'required',
        ]);
        // gelen verileri data adında bir değişkene atar
        $data = $request->except('_token');
        // WorkingHour modeline(veritabanına) yeni bir kayıt oluşturur
        $create = WorkingHour::create($data);
        if ($create) {
            return redirect()->route('admin.workingHour.index')->with('success', 'Çalışma Saati Başarıyla Eklendi');
        } else {
            return back()->with('error', 'Çalışma Saati Eklenemedi');
        }

    }
    public function edit(WorkingHour $workingHour)
    {
        return view('backend.workingHour.edit', compact('workingHour'));
    }
    public function update(Request $request, WorkingHour $workingHour)
    {
        // gelen verileri filtreler
        $request->validate([
            'hour' => 'required',
            'day' => 'required',
        ]);
        // gelen verileri data adında bir değişkene atar
        $data = $request->except('_token');
        // WorkingHour modeline(veritabanına) yeni bir kayıt oluşturur
        $update = $workingHour->update($data);
        if ($update) {
            return redirect()->route('admin.workingHour.index')->with('success', 'Çalışma Saati Başarıyla Güncellendi');
        } else {
            return back()->with('error', 'Çalışma Saati Güncellenemedi');
        }
    }
    public function destroy(WorkingHour $workingHour)
    {
        // gelen çalışma saatini silme işlemi
        $delete = $workingHour->delete();
        if ($delete) {
            return redirect()->route('admin.workingHour.index')->with('success', 'Çalışma Saati Başarıyla Silindi');
        } else {
            return back()->with('error', 'Çalışma Saati Silinemedi');
        }
    }
}
