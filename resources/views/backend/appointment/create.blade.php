@extends('backend.layouts.app')
@section('site_name', 'Ürün Ekle')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    @if($errors->any() && \Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>{{$errors->first()}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any() && \Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>{{$errors->first()}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Randevu oluştur</h6>
                    <form action="{{ route('admin.appointment.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Masa Seçimi</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="desk_id">
                                    <option selected="">Masa Seçiniz</option>
                                    @foreach($desks as $desk)
                                        <option value="{{ $desk->number }}">{{ $desk->number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Gün Seçimi</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="working_hour_id" id="day">
                                    <option selected="">Gün Seçiniz</option>
                                    @foreach($workingHours as $workingHour)
                                        <option value="{{ $workingHour->id }}">{{ $workingHour->day }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3" id="hour">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Saat Seçimi</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="hours" name="appointment_date" >
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Ad-Soyad</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="user_name" placeholder="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="user_email" placeholder="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Telefon Numarası</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="user_phone" placeholder="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('#hour').hide();
            $('#day').change(function () {
                var day = $(this).val();
                $.ajax({
                    type: "POST",
                    url: '{{ route("admin.appointment.hour") }}',
                    data: {'day': day},
                    success: function (data) {
                        $('#hour').show();
                        // $('#hours').html(data.hour);
                        $('#hours').html(' <option value="">Saat Seçiniz</option>');
                        $('#hours').html(data);
                        console.log(data.hour)
                    }
                })
            })
        })
    </script>
@endsection
