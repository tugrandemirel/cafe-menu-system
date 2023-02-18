<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adicional;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function daily()
    {
        // şuanki zaman bilgisi
        $now = Carbon::now();
        // şuanki zaman bilgisinden gün başlangıcını alıyoruz
        $gun_baslangici = $now->startOfDay();
        // gün başlangıcını formatlıyoruz
        $dayStartDate = $gun_baslangici->format('Y-m-d H:i'); // string(16) "2021-10-02 00:00"
        // şuanki zaman bilgisinden gün sonunu alıyoruz
        $gun_sonu = $now->endOfDay();
        // gün sonunu formatlıyoruz
        $dayEndDate = $gun_sonu->format('Y-m-d H:i'); // string(16) "2021-10-08 23:59
        // gün başlangıcı ve gün sonu arasındaki adisyonları alıyoruz
        $adicionales = Adicional::where('created_at' , '>=', $dayStartDate)->where('created_at' , '<=', $dayEndDate)->get();
//        dd($adicionales);
        return view('backend.invoices.daily', compact('adicionales'));
    }
    public function weekly()
    {
        // şuanki zaman bilgisi
        $now = Carbon::now();
        // şuanki zaman bilgisinden hafta başlangıcını alıyoruz
        $hafta_baslangici = $now->startOfWeek(Carbon::TUESDAY);
        // hafta başlangıcını formatlıyoruz
        $weekStartDate = $hafta_baslangici->format('Y-m-d H:i'); // string(16) "2021-10-02 00:00"
        // şuanki zaman bilgisinden hafta sonunu alıyoruz
        $hafta_sonu = $now->endOfWeek(Carbon::MONDAY);
        // hafta sonunu formatlıyoruz
        $weekEndDate = $hafta_sonu->format('Y-m-d H:i'); // string(16) "2021-10-08 23:59
        // hafta başlangıcı ve hafta sonu arasındaki adisyonları alıyoruz
        $adicionales = Adicional::where('created_at' , '>=', $weekStartDate)->where('created_at' , '<=', $weekEndDate)->get();
        return view('backend.invoices.weekly', compact('adicionales'));
    }
}
