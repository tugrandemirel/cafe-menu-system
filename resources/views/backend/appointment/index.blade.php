@extends('backend.layouts.app')
@section('site_name', 'Randevular')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Randevular</h6>
                <a href="{{ route('admin.appointment.create') }}">Randevu Oluştur</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                    <tr class="text-dark">
                        <th scope="col">#</th>

                        <th scope="col">Ad</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefon Numarası</th>
                        <th scope="col">Masa Numarası</th>
                        <th scope="col">Gün</th>
                        <th scope="col">Saat</th>
                        <th scope="col">Tarih</th>
                        @if(auth()->user()->role == 1)    <th scope="col">Action</th> @endif
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($appointments as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{$item->user_name}}</td>
                            <td>{{$item->user_email}}</td>
                            <td>{{$item->user_phone}}</td>
                            <td>{{$item->desk_id}}</td>
                            <td>{{$item->workingHour->day}}</td>
                            <td>{{$item->appointment_date}}</td>
                            <td>{{$item->created_at}}</td>
                            @if(auth()->user()->role == 1)     <td>
                                <a href="{{route('admin.appointment.destroy', $item->id)}}" class="btn btn-sm btn-danger">Sil</a>
                            </td> @endif
                        </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
