
@extends('backend.layouts.app')
@section('site_name', 'Çalışma Düzenle')
@section('css')
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


                    <h6 class="mb-4">çalışma Saati Ekle</h6>
                    <form action="{{ route('admin.workingHour.update', ['workingHour' => $workingHour]) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Çalışma Saati Gün</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="day" value="{{ $workingHour->day }}" placeholder="Pazartesi">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Çalışma Saati</label>
                            <div class="col-sm-6 " id="dynamic_field">
                               @foreach($workingHour->hour as $hour)

                                    <div class="row">
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="hour[]" value="{{$hour}}" placeholder="09.00-10.00">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" name="remove" id="" class="btn btn-danger btn_remove">X</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-sm-3">
                                <button type="button" name="add" id="add" class="btn btn-success">Ekle</button>
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
        $(document).ready(function(){
            $('#add').click(function(){
                var html = '<div class="row mt-2">';
                html += '<div class="col-md-9">';
                html += '<input type="text" name="hour[]" placeholder="09.00-10.00" class="form-control" />';
                html += '</div>';
                html += '<div class="col-md-3">';
                html += '<button type="button" name="remove" id="" class="btn btn-danger btn_remove">X</button>';
                html += '</div>';
                html += '<div>'
                $('#dynamic_field').append(html);
            });
            $(document).on('click', '.btn_remove', function(){
                $(this).closest('.row').remove();
            });
        });
    </script>
@endsection
