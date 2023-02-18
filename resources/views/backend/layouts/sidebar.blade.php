<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ route('admin.desks.index') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('assets/backend/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ \Illuminate\Support\Facades\Auth::user()->name }}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('admin.desks.index') }}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Anasayfa</a>

            @if(auth()->user()->role == 1)
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>Menüler</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('admin.menu.index') }}" class="dropdown-item">Menü Listesi</a>
                    <a href="{{ route('admin.menu.create') }}" class="dropdown-item">Ana Menü Ekle</a>
                    <a href="{{ route('admin.submenu.create') }}" class="dropdown-item">Alt Menü Ekle</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt fa-pro me-2"></i>Ürünler</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('admin.product.index') }}" class="dropdown-item">Ürünler</a>
                    <a href="{{ route('admin.product.create') }}" class="dropdown-item">Ürün Ekle</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-table me-2"></i>Masalar</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('admin.desk.index') }}" class="dropdown-item">Masalar</a>
                    <a href="{{ route('admin.desk.create') }}" class="dropdown-item">Masa Ekle</a>
                </div>
            </div>

            @endif
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-calendar me-2"></i>Randevu</a>
                <div class="dropdown-menu bg-transparent border-0">

                    @if(auth()->user()->role == 1)   <a href="{{ route('admin.workingHour.index') }}" class="dropdown-item">Randevu Saatleri</a>@endif
                    <a href="{{ route('admin.appointment.index') }}" class="dropdown-item">Randevu Listesi</a>
                        @if(auth()->user()->role == 1)   <a href="{{ route('admin.appointment.create') }}" class="dropdown-item">Randevu Oluştur</a>@endif
                </div>
            </div>
            @if(auth()->user()->role == 1)
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-file-invoice"></i>Hesap Döküm</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('admin.invoices.daily') }}" class="dropdown-item">Günlük</a>
                    <a href="{{ route('admin.invoices.weekly') }}" class="dropdown-item">Haftalık</a>
                </div>
            </div>
            <a href="{{ route('admin.contact.index') }}" class="nav-item nav-link"><i class="fa fa-comment me-2"></i>İstek/Şikayet</a>
            <a href="{{ route('admin.setting.index') }}" class="nav-item nav-link active"><i class="fa fa-cogs me-2"></i>Ayarlar</a>

            @endif
        </div>
    </nav>
</div>
