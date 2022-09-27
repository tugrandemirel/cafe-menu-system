<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ route('admin.home') }}" class="navbar-brand mx-4 mb-3">
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
            <a href="{{ route('admin.home') }}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Anasayfa</a>
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
            <a href="{{ route('admin.contact.index') }}" class="nav-item nav-link"><i class="fa fa-comment me-2"></i>İstek/Şikayet</a>
            <a href="{{ route('admin.setting.index') }}" class="nav-item nav-link active"><i class="fa fa-cogs me-2"></i>Ayarlar</a>
        </div>
    </nav>
</div>
