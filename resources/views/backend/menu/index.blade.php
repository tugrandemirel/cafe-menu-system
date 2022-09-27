@extends('backend.layouts.app')
@section('site_name', 'Menü Listesi')
@section('css')
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="bg-light rounded h-100 p-4">
               <div class="row">
                   <div class="col-6">
                       <h6 class="mb-4">Menü Listesi</h6>
                   </div>
               </div>
              @if(isset($menus)  && count($menus) > 0)
                    <div class="bg-light text-center mt-4 rounded pt-4 px-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Ana Menüler</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                <tr class="text-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Menü Adı</th>
                                    <th scope="col">Oluşturulma Tarihi</th>
                                    <th scope="col">Düzenlenme Tarihi</th>
                                    <th scope="col">Durum</th>
                                    <th scope="col">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($menus as $menu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('admin.menu.edit', ['menu' => $menu]) }}">{{ $menu->name }}</a>
                                        </td>
                                        <td>{{ $menu->created_at }}</td>
                                        <td>{{ $menu->updated_at }}</td>
                                        <td>{{ $menu->status }}</td>
                                        <td>
                                            <a href="{{ route('admin.menu.edit', ['menu' => $menu]) }}" class="btn btn-sm btn-primary">Düzenle</a>
                                            <a href="{{ route('admin.menu.delete', ['menu' => $menu]) }}" class="btn btn-sm btn-danger">Sil</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                  <div class="table-responsive" style="margin-top: 50px;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Menü Bulunamadı</h5>
                            <p class="card-text">Menü eklemek için <a href="{{ route('admin.menu.create') }}">tıklayınız</a></p>
                        </div>
                    </div>
                  </div>
              @endif

            </div>

            @if(isset($submenus)  && count($submenus) > 0)
                <div class="bg-light text-center mt-4 rounded pt-4 px-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Alt Menüler</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                            <tr class="text-dark">
                                <th scope="col">#</th>
                                <th scope="col">Resim</th>
                                <th scope="col">Alt Menü Adı</th>
                                <th scope="col">Oluşturulma Tarihi</th>
                                <th scope="col">Düzenlenme Tarihi</th>
                                <th scope="col">Durum</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($submenus as $submenu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ asset($submenu->image) }}" target="_blank">
                                            <img src="{{ asset($submenu->image) }}" width="50" alt="" class="img-thumbnail">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.submenu.edit', ['menu' => $submenu]) }}">{{ $submenu->name }}</a>
                                    </td>
                                    <td>{{ $submenu->created_at }}</td>
                                    <td>{{ $submenu->updated_at }}</td>
                                    <td>{{ $submenu->status }}</td>
                                    <td>
                                        <a href="{{ route('admin.submenu.edit', ['menu' => $submenu]) }}" class="btn btn-sm btn-primary">Düzenle</a>
                                        <a href="{{ route('admin.submenu.delete', ['menu' => $submenu]) }}" class="btn btn-sm btn-danger">Sil</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="table-responsive" style="margin-top: 50px;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Alt Menü Bulunamadı</h5>
                            <p class="card-text">Alt Menü eklemek için <a href="{{ route('admin.submenu.create') }}">tıklayınız</a></p>
                        </div>
                    </div>
                </div>
            @endif
    </div>
    </div>
@endsection
@section('scripts')
@endsection
