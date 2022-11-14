<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\installController;
use App\Http\Controllers\Admin\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('/welcome');
//});

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::post('/contact', [FrontController::class, 'contact'])->name('contact');
Auth::routes();

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
    Route::prefix('menü')->group(function () {

        Route::get('/', [MenuController::class, 'index'])->name('admin.menu.index');
        Route::get('/ekle', [MenuController::class, 'create'])->name('admin.menu.create');
        Route::get('göster/{menu}', [MenuController::class, 'show'])->name('admin.menu.show');
        Route::post('/store', [MenuController::class, 'store'])->name('admin.menu.store');
        Route::get('/düzenle/{menu}', [MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::post('/güncelle/{menu}', [MenuController::class, 'update'])->name('admin.menu.update');
        Route::get('/sil/{menu}', [MenuController::class, 'destroy'])->name('admin.menu.delete');

        Route::prefix('altmenü')->group(function () {
            Route::get('/ekle/', [MenuController::class, 'createSubmenu'])->name('admin.submenu.create');
            Route::get('/göster/{submenu}', [MenuController::class, 'showSubmenu'])->name('admin.submenu.show');
            Route::post('/store/', [MenuController::class, 'storeSubmenu'])->name('admin.submenu.store');
            Route::get('/düzenle/{menu}', [MenuController::class, 'editSubmenu'])->name('admin.submenu.edit');
            Route::post('/güncelle/{menu}', [MenuController::class, 'updateSubmenu'])->name('admin.submenu.update');
            Route::get('/sil/{menu}', [MenuController::class, 'destroySubmenu'])->name('admin.submenu.delete');
        });
    });

    Route::prefix('ürün')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
        Route::get('/ekle', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/düzenle/{product}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('/güncelle/{product}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('/sil/{product}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
        Route::post('/submenu', [ProductController::class, 'getSubmenu'])->name('admin.product.getSubmenu');
    });

    Route::prefix('/kullanıcı')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
    });

    Route::prefix('ayarlar')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('admin.setting.index');
        Route::post('/güncelle', [SettingController::class, 'update'])->name('admin.setting.update');
        Route::post('/sosyalMedya', [SettingController::class, 'socialMediaUpdate'])->name('admin.setting.socialMediaUpdate');
    });

    Route::prefix('iletisim')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('admin.contact.index');
    });
});
