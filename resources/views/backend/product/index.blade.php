@extends('backend.layouts.app')
@section('site_name', 'Ürünler')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Ürünler</h6>
                <a href="{{ route('admin.product.create') }}">Ürün Ekle</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Resim</th>
                        <th scope="col">Ad</th>
                        <th scope="col">Fiyat</th>
                        <th scope="col">İndirim</th>
                        <th scope="col">Status</th>
                        <th scope="col">Güncellenme Tarihi</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($products as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <img src="{{asset($item->image)}}" alt="" width="50">
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}₺</td>
                            <td>{{$item->discount}}₺</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Pasif</span>
                                @endif
                            </td>
                            <td>{{$item->updated_at}}</td>
                            <td>
                                <a href="{{route('admin.product.edit', $item->id)}}" class="btn btn-sm btn-primary">Düzenle</a>
                                <a href="{{route('admin.product.destroy', $item->id)}}" class="btn btn-sm btn-danger">Sil</a>
                            </td>
                        </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
