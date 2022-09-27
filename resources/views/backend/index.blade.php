@extends('backend.layouts.app')
@section('site_name', 'Admin Dashboard')
@section('css')
@endsection
@section('content')

    <!-- Sale & Revenue Start -->

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            @if(isset($products)  && count($products) > 0)
                <div class="bg-light text-center mt-4 rounded pt-4 px-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Son Eklenenler</h6>
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
                            @foreach($products as $submenu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ asset($submenu->image) }}" target="_blank">
                                            <img src="{{ asset($submenu->image) }}" width="50" alt="" class="img-thumbnail">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product.edit', ['product' => $submenu]) }}">{{ $submenu->name }}</a>
                                    </td>
                                    <td>{{ $submenu->created_at }}</td>
                                    <td>{{ $submenu->updated_at }}</td>
                                    <td>
                                        @if($submenu->status == 1)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Pasif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product.edit', ['product' => $submenu]) }}" class="btn btn-sm btn-primary">Düzenle</a>
                                        <a href="{{ route('admin.product.destroy', ['product' => $submenu]) }}" class="btn btn-sm btn-danger">Sil</a>
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
    <!-- Sale & Revenue End -->
    <!-- Widgets End -->
@endsection
@section('scripts')

@endsection
