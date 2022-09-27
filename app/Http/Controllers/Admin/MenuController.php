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
    public function index()
    {
        $menus = Menu::where('parent_id', 0)->orderBy('order', 'ASC')->get();
        $submenus = Menu::where('parent_id', '!=', 0)->orderBy('order', 'ASC')->get();
        return view('backend.menu.index', compact('menus', 'submenus'));
    }

    public function create()
    {
        $menus = Menu::limit(5)->latest()->get();
        return view('backend.menu.create', compact('menus'));
    }

    public function store(MenuStoreRequest $request)
    {
        if (Auth::check())
        {
            $data = $request->except('_token');
            $data['slug'] = Str::slug($data['name']);
            $data['status'] = $request->has('status') ? 1 : 0;
            $data['parent_id'] = 0;
            $menu = Menu::create($data);
            if($menu)
                return redirect()->back()->with('success', 'Menü başarılı bir şekilde oluşturuldu.');
            else
                return redirect()->back()->with('error', 'Menü oluşturulurken bir hata oluştu.');

        }
    }

    public function show($menu)
    {
        $menu = Menu::where('id', $menu)->first();
        $products = Product::where('menu_id', $menu->id)->orderBy('created_at', 'DESC')->get();
        return view('backend.menu.show', compact('menu', 'products'));
    }

    public function edit(Menu $menu)
    {
        return view('backend.menu.edit', compact('menu'));
    }

    public function update(MenuStoreRequest $request, Menu $menu)
    {
        if (Auth::check())
        {
            $data = $request->except('_token');
            $data['slug'] = Str::slug($data['name']);
            $data['status'] = $request->has('status') ? 1 : 0;
            $data['parent_id'] = 0;
            $menu->update($data);
            if($menu)
                return redirect()->back()->with('success', 'Menü başarılı bir şekilde güncellendi.');
            else
                return redirect()->back()->with('error', 'Menü güncellenirken bir hata oluştu.');

        }
    }

    public function destroy($menu)
    {
        if(Auth::check())
        {
            $menu = Menu::find($menu);
            if($menu)
            {
                $menu->delete();
                return redirect()->back()->with('success', 'Menü başarılı bir şekilde silindi.');
            }
            else
                return redirect()->back()->with('error', 'Menü silinirken bir hata oluştu.');
        }
    }

    public function createSubmenu(Menu $menu)
    {
        $menus = Menu::where('status', 1)->where('parent_id', 0)->get();
        return view('backend.menu.submenu.create', compact('menus','menu'));
    }

    public function storeSubmenu(MenuStoreRequest $request, Menu $menu)
    {
        if (Auth::check())
        {
            $data = $request->except('_token');
            $data['slug'] = Str::slug($data['name']);
            $data['image'] = \ImageHelpers::uploadImage($data['image'], 'images/menu/');
            $data['status'] = $request->has('status') ? 1 : 0;
            $menu = Menu::create($data);
            if($menu)
                return redirect()->back()->with('success', 'Alt Menü başarılı bir şekilde oluşturuldu.');
            else
                return redirect()->back()->with('error', 'Alt Menü oluşturulurken bir hata oluştu.');

        }
    }

    public function editSubmenu(Menu $menu)
    {
        $menus = Menu::where('status', 1)->where('parent_id', 0)->get();
        return view('backend.menu.submenu.edit', compact('menus','menu'));
    }

    public function updateSubmenu(MenuStoreRequest $request, Menu $menu)
    {
        if (Auth::check())
        {
            $data = $request->except('_token');
            $data['slug'] = Str::slug($data['name']);
            if ($request->hasFile('image')){
                \ImageHelpers::deleteImage($menu->image);
                $data['image'] = \ImageHelpers::uploadImage($data['image'], 'images/menu/');
            }
            $data['status'] = $request->has('status') ? 1 : 0;
            $menu->update($data);
            if($menu)
                return redirect()->back()->with('success', 'Menü başarılı bir şekilde güncellendi.');
            else
                return redirect()->back()->with('error', 'Menü güncellenirken bir hata oluştu.');

        }
    }

    public function destroySubmenu($menu)
    {
        if(Auth::check())
        {
            $menu = Menu::find($menu);
            if($menu)
            {
                $menu->delete();
                \ImageHelpers::deleteImage($menu->image, 'images/menu/');
                return redirect()->back()->with('success', 'Menü başarılı bir şekilde silindi.');
            }
            else
                return redirect()->back()->with('error', 'Menü silinirken bir hata oluştu.');
        }
    }
}
