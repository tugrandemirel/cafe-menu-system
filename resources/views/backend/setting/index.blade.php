@extends('backend.layouts.app')
@section('site_name', 'Site Ayarları')
@section('css')
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Site Ayarları</h6>
                    <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" value="{{ isset($setting) ? $setting->title : ''}}" id="floatingInput" name="title" required>
                            <label for="floatingInput">Site Adı</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" name="logo" id="floatingLogo">
                            <label for="floatingLogo">Logo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" name="favicon" id="floatingFavicon">
                            <label for="floatingFavicon">Favicon</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" value="{{ isset($setting) ? $setting->email : ''}}" maxlength="11" id="floatingEmail" >
                            <label for="floatingEmail">Email Adresi</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" name="phone" value="{{ isset($setting) ? $setting->phone : ''}}" maxlength="11" id="floatingPhone" >
                            <label for="floatingPhone">Telefon Numarası</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="address" value="{{ isset($setting) ? $setting->address : ''}}" id="floatingadress" required>
                            <label for="floatingadress">Adres</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="keywords" value="{{ isset($setting) ? $setting->keywords : ''}}" id="floatingKeywords" >
                            <label for="floatingKeywords">Site Keywords</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="description" id="floatingTextarea" style="height: 150px;" required>{{ isset($setting) ? $setting->description : ''}}</textarea>
                            <label for="floatingTextarea">Site Açıklaması</label>
                        </div>
                        <div class="form-floating mt-3">
                            <button class="btn btn-primary" type="submit">Güncelle</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Sosyal Medya Ayarları</h6>
                    <form action="{{ route('admin.setting.socialMediaUpdate')}}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text">Facebook</span>
                            <input type="text" name="facebook" value="{{ isset($socialmedia) ? $socialmedia->facebook : ''}}"  class="form-control" placeholder="https://www.facebook.com/TTugranDemirel/">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Twitter</span>
                            <input type="text" name="twitter" class="form-control"  value="{{ isset($socialmedia) ? $socialmedia->twitter : ''}}"  placeholder="https://twitter.com/tugrandemirel">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Instagram</span>
                            <input type="text" name="instagram" class="form-control"  value="{{ isset($socialmedia) ? $socialmedia->instagram : ''}}"  placeholder="https://www.instagram.com/demirel.tugran/">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Youtube</span>
                            <input type="text" name="youtube" class="form-control"  value="{{ isset($socialmedia) ? $socialmedia->youtube : ''}}"  placeholder="https://www.youtube.com/channel/UC15jYv7uOes0VbbTHoVdZkw">
                        </div>
                        <div class="form-floating mt-3">
                            <button class="btn btn-primary" type="submit">Güncelle</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
@endsection
