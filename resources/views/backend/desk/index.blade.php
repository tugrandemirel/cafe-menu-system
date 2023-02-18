@extends('backend.layouts.app')
@section('site_name', 'Masalar')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Masalar</h6>
                <a href="{{ route('admin.desk.create') }}">Masa Ekle</a>
            </div>
            <div class="row">
                @foreach($desks as $desk)
                    <div class="col-md-4 mt-5">
                        <div class="card" style="width: 18rem; background-color: {{ $desk->status == 1 ? 'greenyellow' : 'red' }}">
                            <div class="card-body">
                                <h5 class="card-title">Masa Numarası: {{ $desk->number }}</h5>
                                <h5 class="card-title">Masa Kapasitesi: {{ $desk->capacity }}</h5>
                                <div class="card-body">
                                    <a href="{{ route('admin.desk.edit', ['desk' => $desk]) }}" class="cart-link">Masa Düzenle</a>
                                    <br>
                                    <a href="{{ route('admin.desk.destroy', ['desk' => $desk]) }}" class="cart-link">Masa Sil</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
            </div>

        </div>
    </div>
@endsection
