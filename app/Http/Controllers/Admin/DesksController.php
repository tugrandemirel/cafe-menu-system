<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adicional;
use App\Models\AdicionalProduct;
use App\Models\Desk;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class DesksController extends Controller
{
    public function index()
    {
        // desk tablosundaki bütün masaları numaraya göre sıralayarak getir.
        $desks = Desk::orderBy('number', 'asc')->get();
        return view('backend.desks.index', compact('desks'));
    }

    public function create(Desk $desk)
    {
        // bana backend klasörü altında product klavörü altında index.blade.php dosyasını göster. gösterirken ilgili sayfaya product verisini gönder.
        $menus = Menu::where('status', 1)->where('parent_id', '==',0)->get();
        return view('backend.desks.create', compact('menus', 'desk'));
    }

    // masaya ürün ekleme fonkisyonu
    public function store(Request $request, Desk $desk)
    {
        $data = $request->except('_token');
        // desk_id ile ilgili adisyon var mı kontrol et.
        $c = Adicional::where('desk_id', $desk->id)->where('status', 1)->count();
        // eğer varsa ürünü adisyon ürün tablosuna ekle.
        if ($c > 0) {
            $adicional = Adicional::where('desk_id', $desk->id)->where('status', 1)->first();
            AdicionalProduct::create([
                'adicional_id' => $adicional->id,
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'price' => $data['price'],
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Ürün başarıyla eklendi.'
            ]);
        }
        // eğer yoksa adisyon oluştur ve ürünü adisyon ürün tablosuna ekle.
        else
        {
            $adicional = Adicional::create([
                'desk_id' => $desk->id,
                'status' => 1
            ]);
            Desk::where('id', $desk->id)->update([
                'status' => 0
            ]);
            AdicionalProduct::create([
                'adicional_id' => $adicional->id,
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'price' => $data['price'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Ürün başarıyla eklendi.'
            ]);
        }
    }

    // masaya ait adisyonu ödeme fonksiyonu
    public function pay(Request $request)
    {
        $data = $request->except('_token');
        // masayı bul ve masayı boş hale getir
        $desk = Desk::find($data['desk_id']);
        $desk->status = 1;
        $desk->save();
        // masaya ait adisyonu bul ve adisyonu ödeme haline getir
        $adicional = Adicional::where('desk_id', $desk->id)->where('status', 1)->first();
        $adicional->status = 0;
        $adicional->save();

        return redirect()->route('admin.desks.index');
    }
}
