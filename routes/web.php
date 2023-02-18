<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DeskController;
use App\Http\Controllers\Admin\DesksController;
use App\Http\Controllers\Admin\WorkingHourController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\AppointmentController;

// www.domain.com/
Route::get('/', [FrontController::class, 'index'])->name('index');

// www.domain.com/contact
Route::post('/contact', [FrontController::class, 'contact'])->name('contact');
Auth::routes();

// group içerisinde blunan bütün rotaları admin/.... eki ile birleştirme işlemi
Route::middleware(['auth'])->prefix('admin')->group(function () {

// www.domain.com/
    Route::prefix('/anasayfa')->group(function () {
        // www.domain.com/admin/
        Route::get('/', [DesksController::class, 'index'])->name('admin.desks.index');
        // www.domain.com/admin/ekle/5
        Route::get('/ekle/{desk}', [DesksController::class, 'create'])->name('admin.desks.create');
        // www.domain.com/admin/ekle/5(post)
        Route::post('/ekle/{desk}', [DesksController::class, 'store'])->name('admin.desks.store');

        Route::post('/ödeme/{desk}', [DesksController::class, 'pay'])->name('admin.desks.pay');
    });

    // www.domain.com/admin/menü
    Route::prefix('menü')->middleware('isAdmin')->group(function () {
// www.domain.com/admin/menü
        Route::get('/', [MenuController::class, 'index'])->name('admin.menu.index');
        // www.domain.com/admin/menüler
        Route::get('/ekle', [MenuController::class, 'create'])->name('admin.menu.create');

        // www.domain.com/admin/menü/1
        Route::get('göster/{menu}', [MenuController::class, 'show'])->name('admin.menu.show');
        Route::post('/store', [MenuController::class, 'store'])->name('admin.menu.store');

        // www.domain.com/admin/menü/1
        Route::get('/düzenle/{menu}', [MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::post('/güncelle/{menu}', [MenuController::class, 'update'])->name('admin.menu.update');

        // www.domain.com/admin/menü/1
        Route::get('/sil/{menu}', [MenuController::class, 'destroy'])->name('admin.menu.delete');

        // www.domain.com/admin/menü/altmenü
        Route::prefix('altmenü')->group(function () {
            // www.domain.com/admin/menü/altmenü/ekle
            Route::get('/ekle/', [MenuController::class, 'createSubmenu'])->name('admin.submenu.create');
            // www.domain.com/admin/menü/altmenü/goster/1
            Route::get('/göster/{submenu}', [MenuController::class, 'showSubmenu'])->name('admin.submenu.show');
            Route::post('/store/', [MenuController::class, 'storeSubmenu'])->name('admin.submenu.store');
            // www.domain.com/admin/menü/altmenü/düzenle/1
            Route::get('/düzenle/{menu}', [MenuController::class, 'editSubmenu'])->name('admin.submenu.edit');
            Route::post('/güncelle/{menu}', [MenuController::class, 'updateSubmenu'])->name('admin.submenu.update');

            // www.domain.com/admin/menü/altmenü/sil/1
            Route::get('/sil/{menu}', [MenuController::class, 'destroySubmenu'])->name('admin.submenu.delete');
        });
    });

    // www.domain.com/admin/ürün
    Route::prefix('ürün')->middleware('isAdmin')->group(function () {
        // www.domain.com/admin/ürün
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
        // www.domain.com/admin/ürün/ekle
        Route::get('/ekle', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        // www.domain.com/admin/ürün/düzenle/1
        Route::get('/düzenle/{product}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('/güncelle/{product}', [ProductController::class, 'update'])->name('admin.product.update');
        // www.domain.com/admin/ürün/sil/1
        Route::get('/sil/{product}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
        Route::post('/submenu', [ProductController::class, 'getSubmenu'])->name('admin.product.getSubmenu');
    });

    // www.domain.com/admin/masa
    Route::prefix('masa')->middleware('isAdmin')->group(function (){
        // www.domain.com/admin/masa
        Route::get('/', [DeskController::class, 'index'])->name('admin.desk.index');
        // www.domain.com/admin/masa/ekle
        Route::get('/ekle', [DeskController::class, 'create'])->name('admin.desk.create');
        // www.domain.com/admin/masa/ekle(post)
        Route::post('/ekle', [DeskController::class, 'store'])->name('admin.desk.store');
        // www.domain.com/admin/masa/düzenle/{desk}
        Route::get('/düzenle/{desk}', [DeskController::class, 'edit'])->name('admin.desk.edit');
        // www.domain.com/admin/masa/güncelle/{desk} (post)
        Route::post('/güncelle/{desk}', [DeskController::class, 'update'])->name('admin.desk.update');
        // www.domain.com/admin/masa/sil/{desk}
        Route::get('/sil/{desk}', [DeskController::class, 'destroy'])->name('admin.desk.destroy');
    });

    // www.domain.com/admin/calisma-saatleri
    Route::prefix('calisma-saatleri')->middleware('isAdmin')->group(function (){
        // www.domain.com/admin/çalışma-saatleri
        Route::get('/', [WorkingHourController::class, 'index'])->name('admin.workingHour.index');
        // www.domain.com/admin/çalışma-saatleri/ekle
        Route::get('/ekle', [WorkingHourController::class, 'create'])->name('admin.workingHour.create');
        // www.domain.com/admin/çalışma-saatleri/ekle(post)
        Route::post('/ekle', [WorkingHourController::class, 'store'])->name('admin.workingHour.store');
        // www.domain.com/admin/çalışma-saatleri/düzenle/{workingHour}
        Route::get('/düzenle/{workingHour}', [WorkingHourController::class, 'edit'])->name('admin.workingHour.edit');
        // www.domain.com/admin/çalışma-saatleri/güncelle/{workingHour} (post)
        Route::post('/güncelle/{workingHour}', [WorkingHourController::class, 'update'])->name('admin.workingHour.update');
        // www.domain.com/admin/çalışma-saatleri/sil/{workingHour}
        Route::get('/sil/{workingHour}', [WorkingHourController::class, 'destroy'])->name('admin.workingHour.destroy');
    });

    // www.domain.com/admin/randevu
    Route::prefix('randevu')->group(function (){
        // www.domain.com/admin/randevu/ekle
        Route::get('/listesi', [AppointmentController::class, 'index'])->name('admin.appointment.index');

        Route::get('/ekle', [AppointmentController::class, 'create'])->name('admin.appointment.create');

        Route::post('/ekle', [AppointmentController::class, 'store'])->name('admin.appointment.store');

        Route::get('/sil/{appointment}', [AppointmentController::class, 'destroy'])->name('admin.appointment.destroy');

        Route::post('/saat', [AppointmentController::class, 'getHour'])->name('admin.appointment.hour');
    });

    // www.domain.com/admin/faturalar
    Route::prefix('faturalar')->middleware('isAdmin')->group(function (){
        // www.domain.com/admin/faturalar/günlük
        Route::get('/günlük', [InvoiceController::class, 'daily'])->name('admin.invoices.daily');
        // www.domain.com/admin/faturalar/haftalık
        Route::get('/haftalık', [InvoiceController::class, 'weekly'])->name('admin.invoices.weekly');

    });

    // www.domain.com/admin/kullanıcı
    Route::prefix('/kullanıcı')->middleware('isAdmin')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
//        Route::get('/ekle', [UserController::class, 'index'])->name('admin.user.index');
    });

    // www.domain.com/admin/ayarlar
    Route::prefix('ayarlar')->middleware('isAdmin')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('admin.setting.index');
        Route::post('/güncelle', [SettingController::class, 'update'])->name('admin.setting.update');
        Route::post('/sosyalMedya', [SettingController::class, 'socialMediaUpdate'])->name('admin.setting.socialMediaUpdate');
    });

    // www.domain.com/admin/iletisim
    Route::prefix('iletisim')->middleware('isAdmin')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('admin.contact.index');
    });

});
