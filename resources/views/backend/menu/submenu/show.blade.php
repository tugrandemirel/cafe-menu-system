@extends('backend.layouts.app')
@section('site_name', $submenu->name.' Ürün Listesi')
@section('css')
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="bg-light rounded h-100 p-4">
               <div class="row">
                   <div class="col-6">
                       <h6 class="mb-4">Ürün Listesi</h6>
                   </div>
               </div>
              @if(isset($products)  && count($products) > 0)
                    <div class="bg-light text-center mt-4 rounded pt-4 px-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">{{ $submenu->name }} İçeriği</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                <tr class="text-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Resim</th>
                                    <th scope="col">Ürün Adı</th></th>
                                    <th scope="col">Oluşturulma Tarihi</th>
                                    <th scope="col">Düzenlenme Tarihi</th>
                                    <th scope="col">Durum</th>
                                    <th scope="col">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50">
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>{{ $product->updated_at }}</td>
                                        <td>
                                            @if($product->status == 1)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Pasif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.product.edit', ['product' => $product]) }}" class="btn btn-sm btn-primary">Düzenle</a>
                                            <a href="{{ route('admin.product.destroy', ['product' => $product]) }}" class="btn btn-sm btn-danger">Sil</a>
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
                            <p class="card-text">Ürün eklemek için <a href="{{ route('admin.product.create') }}">tıklayınız</a></p>
                        </div>
                    </div>
                  </div>
              @endif
            </div>
    </div>
    </div>
@endsection
@section('scripts')
@endsection
