<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class MenuController extends Controller
{
    // menulerin listelendiği fonksiyon
    public function index()
    {
        // ana menülerin listelenmesi
        $menus = Menu::where('parent_id', 0)->orderBy('order', 'ASC')->get();
        // alt menülerin listelenmesi
        $submenus = Menu::where('parent_id', '!=', 0)->orderBy('order', 'ASC')->get();
        // ana ve altmenüleri view e gönder
        return view('backend.menu.index', compact('menus', 'submenus'));
    }

    public function create()
    {
        // ana menülerin ait 5 adet ana menünün listelenmesi
        $menus = Menu::limit(5)->latest()->get();
        // ana menüleri view e gönder
        return view('backend.menu.create', compact('menus'));
    }

    public function store(MenuStoreRequest $request)
    {
        // kullanıcı login olmuş mu kontrol et
        if (Auth::check())
        {
            $data = $request->except('_token');
            // menü adı boş mu kontrol et
            if ($data['name'] == null)
                return redirect()->back()->with('error', 'Menü adı giriniz.');
            $data['slug'] = Str::slug($data['name']);
            $data['status'] = $request->has('status') ? 1 : 0;
            $data['parent_id'] = 0;
            // menüyü veritabanına kaydet
            $menu = Menu::create($data);
            if($menu)
                return redirect()->back()->with('success', 'Menü başarılı bir şekilde oluşturuldu.');
            else
                return redirect()->back()->with('error', 'Menü oluşturulurken bir hata oluştu.');

        }
        else
            return redirect()->back();
    }

    // menüyü göster
    public function show($menu)
    {
        // menüyü id ile bul
        $menu = Menu::where('id', $menu)->first();
        // menüye ait ürünleri bul
        $products = Product::where('menu_id', $menu->id)->orderBy('created_at', 'DESC')->get();
        // menü ve ürünleri view e gönder
        return view('backend.menu.show', compact('menu', 'products'));
    }

    // menu düzenleme methodu
    public function edit(Menu $menu)
    {
        // menu düzenleme sayfasına gönder
        return view('backend.menu.edit', compact('menu'));
    }

    // menu güncelleme methodu
    public function update(MenuStoreRequest $request, Menu $menu)
    {
        // kullanıcı login olmuş mu kontrol et
        if (Auth::check())
        {
            $data = $request->except('_token');
            if ($data['name'] == null)
                return redirect()->back()->with('error', 'Menü adı giriniz.');
            $data['slug'] = Str::slug($data['name']);
            $data['status'] = $request->has('status') ? 1 : 0;
            $data['parent_id'] = 0;
            // menüyü veritabanınnda güncelle
            $menu->update($data);
            if($menu)
                return redirect()->back()->with('success', 'Menü başarılı bir şekilde güncellendi.');
            else
                return redirect()->back()->with('error', 'Menü güncellenirken bir hata oluştu.');

        }
        else
            return redirect()->back();
    }

    // menu silme methodu
    public function destroy($menu)
    {
        // kullanıcı login olmuş mu kontrol et
        if(Auth::check())
        {
            // menüyü id ile bul
            $menu = Menu::find($menu);
            if($menu)
            {
                // menüyü veritabanından sil
                $menu->delete();
                return redirect()->back()->with('success', 'Menü başarılı bir şekilde silindi.');
            }
            else
                return redirect()->back()->with('error', 'Menü silinirken bir hata oluştu.');
        }
        else
            return redirect()->back();
    }

    // alt menü oluşturma methodu
    public function createSubmenu(Menu $menu)
    {
        // ana menülerin listelenmesi
        $menus = Menu::where('status', 1)->where('parent_id', 0)->get();
        // ana menüleri view e gönder
        return view('backend.menu.submenu.create', compact('menus','menu'));
    }

    // alt menü kaydetme methodu
    public function storeSubmenu(MenuStoreRequest $request, Menu $menu)
    {
        // kullanıcı login olmuş mu kontrol et
        if (Auth::check())
        {
            $data = $request->except('_token');
            if ($data['name'] == null)
                return redirect()->back()->with('error', 'Lütfen Menü adı giriniz.');
            $data['slug'] = Str::slug($data['name']);
            // resim var mı yok mu kontrol et
            if (!$request->hasFile('image'))
                return redirect()->back()->with('error', 'Lütfen resim seçiniz.');
            $data['image'] = \ImageHelpers::uploadImage($data['image'], 'images/menu/');
            $data['status'] = $request->has('status') ? 1 : 0;
            // altmenuyu veritabanına kaydet
            $menu = Menu::create($data);
            if($menu)
                return redirect()->back()->with('success', 'Alt Menü başarılı bir şekilde oluşturuldu.');
            else
                return redirect()->back()->with('error', 'Alt Menü oluşturulurken bir hata oluştu.');

        }
        else
            return redirect()->back();
    }

    // alt menüyü göster
    public function showSubmenu($submenu)
    {
        // alt menüyü id ile bul
        $submenu = Menu::where('id', $submenu)->first();
        // alt menüye ait ürünleri bul
        $products = Product::where('parent_id', $submenu->id)->orderBy('created_at', 'DESC')->get();
        // alt menü ve ürünleri view e gönder
        return view('backend.menu.submenu.show', compact('submenu', 'products'));
    }

    // alt menü düzenleme methodu
    public function editSubmenu(Menu $menu)
    {
        // alt menuye ait ürünlerin bulunması
        $menus = Menu::where('status', 1)->where('parent_id', 0)->get();
        // alt menüyü view e gönder
        return view('backend.menu.submenu.edit', compact('menus','menu'));
    }

    // alt menü güncelleme methodu
    public function updateSubmenu(MenuStoreRequest $request, Menu $menu)
    {
        // kullanıcı login olmuş mu kontrol et
        if (Auth::check())
        {
            $data = $request->except('_token');
            if ($data['name'] == null)
                return redirect()->back()->with('error', 'Lütfen Menü adı giriniz.');
            $data['slug'] = Str::slug($data['name']);
            if ($request->hasFile('image')){
                \ImageHelpers::deleteImage($menu->image);
                $data['image'] = \ImageHelpers::uploadImage($data['image'], 'images/menu/');
            }
            $data['status'] = $request->has('status') ? 1 : 0;
            // menüyü veritabanınnda güncelle
            $menu->update($data);
            if($menu)
                return redirect()->back()->with('success', 'Menü başarılı bir şekilde güncellendi.');
            else
                return redirect()->back()->with('error', 'Menü güncellenirken bir hata oluştu.');

        }
        else
            return redirect()->back();
    }

    // alt menü silme methodu
    public function destroySubmenu($menu)
    {
        // kullanıcı login olmuş mu kontrol et
        if(Auth::check())
        {
            // menüyü id ile bul
            $menu = Menu::find($menu);
            if($menu)
            {
                // menüyü veritabanından sil
                $menu->delete();
                \ImageHelpers::deleteImage($menu->image, 'images/menu/');
                return redirect()->back()->with('success', 'Menü başarılı bir şekilde silindi.');
            }
            else
                return redirect()->back()->with('error', 'Menü silinirken bir hata oluştu.');
        }
        else
            return redirect()->back();
    }


}
