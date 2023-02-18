<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Desk;
use App\Models\WorkingHour;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // büütün randevuları göster
    public function index()
    {
        // tüm randevuları çek
        $appointments = Appointment::all();
        // randevuları view içerisinde göster
        return view('backend.appointment.index', compact('appointments'));
    }

    // randevu oluşturma sayfasını göster
    public function create()
    {
        // tüm masaları çek
        $desks = Desk::all();
        // tüm çalışma saatlerini çek
        $workingHours = WorkingHour::all();
        // randevu oluşturma sayfasını göster
        return view('backend.appointment.create', compact('desks', 'workingHours'));
    }

    // randevu oluşturma işlemini yap
    public function store(Request $request)
    {
        // formdan gelen verileri al
        $data = $request->except('_token');
        // randevuyu oluştur
        $create = Appointment::create($data);
        // oluşturulan randevuyu göster
        return redirect()->back()->with('success', 'Appointment created successfully');

    }

    // randevu silme işlemini yap
    public function destroy($appointment)
    {
        // randevuyu bul
        $appointment = Appointment::find($appointment);
        // randevuyu sil
        $appointment->delete();
        // önceki sayfaya gönder
        return redirect()->back()->with('success', 'Appointment deleted successfully');
    }

    // saatleri getir
    public function getHour(Request $request)
    {
        // günü bul
        $workingHours = WorkingHour::where('id', $request->day)->get();
        $arr = [];
        // günleri döngüye al
        foreach ($workingHours as $workingHour) {
            // günlere ait saatleri döngüye al
           foreach ($workingHour->hour as $hour) {
                // saatleri diziye ekle
               $arr[] = '<option  value="'.$hour.'">'.$hour.'</option>';
           }
        }
        // saatleri json olarak gönder
        return response()->json($arr);
    }
}
