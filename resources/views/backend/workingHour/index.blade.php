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
                        <h6 class="mb-4">Çalışma Saatleri</h6>
                    </div>
                </div>
                @if(isset($workingHours) && count($workingHours) > 0)
                    <div class="bg-light text-center mt-4 rounded pt-4 px-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Çalışma Saatleri</h6>
                            <a href="{{ route('admin.workingHour.create') }}" class="btn btn-primary btn-sm">Çalışma Saati Ekle</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                <tr class="text-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Günler</th>
                                    <th scope="col">Randevu Aralık Sayısı</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($workingHours as $workingHour)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                           <td>{{ $workingHour->day}}</td>
                                           <td>{{ count($workingHour->hour) }}</td>
                                        <td>
                                            <a href="{{ route('admin.workingHour.edit', ['workingHour' => $workingHour]) }}" class="btn btn-sm btn-primary">Düzenle</a>
                                            <a href="{{ route('admin.workingHour.destroy', ['workingHour' => $workingHour]) }}" class="btn btn-sm btn-danger">Sil</a>
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
                                <h5 class="card-title">çalışma Saati Bulunamadı</h5>
                                <p class="card-text">çalışma Saati Eklemek için <a href="{{ route('admin.workingHour.create') }}">tıklayınız</a></p>
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
