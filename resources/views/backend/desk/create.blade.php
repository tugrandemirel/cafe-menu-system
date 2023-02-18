@extends('backend.layouts.app')
@section('site_name', 'Masa Ekle')
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

                    <form action="{{ route('admin.desk.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="" class="form-label">Masa Numarası</label>
                            <input type="number" class="form-control" name="number" placeholder="Masa Numarası">
                        </div>
                        <div class="row mb-3">
                            <label for="" class="form-label">Masa Kapasitesi</label>
                            <input type="number" class="form-control" name="capacity" placeholder="Masa Kapasitesi">
                        </div>
                        <div class="row mb-3">
                            <legend class="col-form-label col-sm-1 pt-0">Durum</legend>
                            <div class="col-sm-11">
                                <div class="form-check">
                                    <input class="form-check-input" name="status" type="checkbox" id="gridCheck1">
                                </div>
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
@endsection
