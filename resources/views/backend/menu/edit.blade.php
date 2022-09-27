@extends('backend.layouts.app')
@section('site_name', $menu->name.' - Menü Düzenle')
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


                    <h6 class="mb-4">Ana Menü Düzenle</h6>
                    <form action="{{ route('admin.menu.update', ['menu' => $menu]) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Ana Menü Adı</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{ $menu->name }}">
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <legend class="col-form-label col-sm-1 pt-0">Durum</legend>
                            <div class="col-sm-11">
                                <div class="form-check">
                                    <input class="form-check-input" name="status" type="checkbox" {{ ($menu->status === 1 ) ? 'checked' : '' }} id="gridCheck1">
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
