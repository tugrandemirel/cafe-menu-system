<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Menu;
use App\Models\ProductMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductController extends Controller
{

    // ürünlerin listelendiği sayfa
    public function index()
    {
        // bana backend klasörü altında product klavörü altında index.blade.php dosyasını göster. gösterirken ilgili sayfaya product verisini gönder
        $products = Product::with('menus', 'submenus')->get();
        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        // bana backend klasörü altında product klavörü altında create.blade.php dosyasını göster Menus verisini gönder
        $menus = Menu::where('parent_id', 0)->where('status', 1)->get();
        return view('backend.product.create', compact('menus'));
    }

    public function store(ProductRequest $request)
    {
        // create sayfası içerisinden gelen bilgileri veritabaına kayıt eden fonksiyon
        $data = $request->except('_token');

        // menu secilmemisse hata ver
        if (empty($data['menu_id']) || empty($data['parent_id']))
            return redirect()->back()->with('error', 'Lütfen menü seçiniz');
        $data['slug'] = Str::slug($request->name);
        // resim var mı yok mu kontrolü
        if ($request->hasFile('image'))
            $data['image'] = \ImageHelpers::uploadImage($data['image'], 'images/product/');
        else
            return redirect()->back()->with('error', 'Lütfen resim seçiniz');
        // fiyat kontrolü
        if (empty($data['price']))
            return redirect()->back()->with('error', 'Lütfen fiyat giriniz');
        $data['status'] = $request->has('status') ? 1 : 0;

        $product = Product::create($data);

        if($product)
        {
            ProductMenu::create([
                'product_id' => $product->id,
                'menu_id' => $request->menu_id,
            ]);
            return redirect()->back()->with('success', 'Ürün başarılı bir şekilde oluşturuldu.');
        }
        else
            return redirect()->back()->with('error', 'Ürün oluşturulurken bir hata oluştu.');
    }

    public function edit($id)
    {
        // bana backend klasörü altında product klavörü altında edit.blade.php dosyasını göster Menus Product verisini gönder
        $product = Product::find($id);
        $menus = Menu::where('parent_id', 0)->where('status', 1)->get();
        return view('backend.product.edit', compact('product', 'menus'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->except('_token');
        if (empty($data['menu_id']) || empty($data['parent_id']))
            return redirect()->back()->with('error', 'Lütfen menü seçiniz');
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('image'))
            $data['image'] = \ImageHelpers::uploadImage($data['image'], 'images/product/');
        if (empty($data['price']))
            return redirect()->back()->with('error', 'Lütfen fiyat giriniz');
        $data['status'] = $request->has('status') ? 1 : 0;

        $product->update($data);
        if($product)
        {
            ProductMenu::where('product_id', $product->id)->update([
                'menu_id' => $request->menu_id,
                'product_id' => $product->id,
            ]);
            return redirect()->back()->with('success', 'Ürün başarılı bir şekilde güncellendi.');
        }
        else
            return redirect()->back()->with('error', 'Ürün güncellenirken bir hata oluştu.');
    }

    public function destroy(Product $product)
    {
        \ImageHelpers::deleteImage($product->image);
        $product->delete();
        if($product)
            return redirect()->back()->with('success', 'Ürün başarılı bir şekilde silindi.');
        else
            return redirect()->back()->with('error', 'Ürün silinirken bir hata oluştu.');
    }

    public function getSubmenu(Request $request)
    {
        $submenus = Menu::where('parent_id', $request->menu)->where('status', 1)->get();
        $arr = [];
        foreach ($submenus as $item)
        {
            $arr[] = '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        return response()->json($arr);
    }
}
