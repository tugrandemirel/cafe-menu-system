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
                    <h6 class="mb-4">Alt Menü Ekle</h6>
                    <form action="{{ route('admin.product.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Ana Menü Seçimi</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="menu_id" id="menu">
                                    <option selected="">Ana Menü Seçiniz</option>
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Alt Menü Seçimi</label>
                            <div class="col-sm-9">
                                <select name="parent_id" class="form-select" id="submenu">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="form-label">Ürün Adı</label>
                            <input type="text" class="form-control" name="name" placeholder="Ürün Adı">
                        </div>
                        <div class="row mb-3">
                            <label for="formFile" class="form-label">Ürün Resmi</label>
                            <input class="form-control" type="file" name="image">
                        </div>
                        <div class="row mb-3">
                            <label for="formFile" class="form-label">İçerik</label>
                            <textarea name="description" class="form-control" id="" cols="30" rows="1"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="" class="form-label">Fiyat</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">₺</span>
                                    <input type="text" class="form-control" name="price" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">İndirimli Fiyat</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">₺</span>
                                    <input type="text" class="form-control" name="discount" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('#submenu').hide();
            $('#menu').change(function () {
                var menu_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: '{{ route("admin.product.getSubmenu") }}',
                    data: {'menu': menu_id},
                    success: function (data) {
                        $('#submenu').show();
                        $('#submenu').append(data);
                    }
                })
            })
        })
    </script>
@endsection
