@extends('backend.layouts.app')
@section('site_name', 'Menü Güncelle')
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
                </div>
            </div>
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Alt Menü Güncelle</h6>
                    <form action="{{ route('admin.submenu.update', ['menu' => $menu]) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Ana Menü Seçimi</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="parent_id" id="">
                                    <option selected="">Ana Menü Seçiniz</option>
                                    @foreach($menus as $value)
                                        <option {{ $value->id === $menu->parent_id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Alt Menü Adı</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{ $menu->name }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <img src="{{ asset($menu->image) }}" class="img-thumbnail" width="100">
                            </div>
                            <div class="col-md-6">
                                <label for="formFile" class="form-label">Ana Menü Resim</label>
                                <input class="form-control" type="file" name="image">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <legend class="col-form-label col-sm-1 pt-0">Durum</legend>
                            <div class="col-sm-11">
                                <div class="form-check">
                                    <input class="form-check-input"  {{ ($menu->status === 1 ) ? 'checked' : '' }} name="status" type="checkbox" id="gridCheck1">
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
