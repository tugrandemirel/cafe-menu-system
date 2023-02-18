@extends('backend.layouts.app')
@section('site_name', 'Masalar')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Masalar</h6>
                <a href="{{ route('admin.appointment.create') }}" class="btn btn-sm btn-primary">Randevu Oluştur</a>
            </div>
            <div class="row">
                @foreach($desks as $desk)
                    <div class="col-md-4 mt-5">
                        <div class="card" style="width: 18rem; background-color: {{ $desk->status == 1 ? 'greenyellow' : 'red' }}">
                            <div class="card-body">
                                <h5 class="card-title">Masa Numarası: {{ $desk->number }}</h5>
                                <h5 class="card-title">Toplam Kapasite: {{ $desk->capacity }}</h5>
                                <div class="card-body">

                                    <br>
                                    <a href="{{ route('admin.desks.create', ['desk' => $desk]) }}" class="cart-link">Ürün Gir/Düzenle</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
            </div>

        </div>
    </div>
@endsection
