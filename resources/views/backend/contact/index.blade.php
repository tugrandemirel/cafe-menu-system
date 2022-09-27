@extends('backend.layouts.app')
@section('css')
@endsection
@section('site_name', 'İstek Şikayet')
    @section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">İstek/Şikayet</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Ad Soyad</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gönderilme tarihi</th>
                        <th scope="col">Ayrıntılar</th>
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($suggestion as $item)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td >{{$item->created_at}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal{{ $item->id }}" >Görüntüle</button>
                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header " >
                                                <h5 class="modal-title" id="exampleModalLabel" style="color: black;">İstek/Şikayet</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                                <div class="modal-body" style="color: black;">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="" class="text-left col-form-label">Ad-Soyad:</label>
                                                        <input type="text" class="form-control" value="{{ $item->name }}" id="recipient-name"  disabled >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">E-mail</label>
                                                        <input type="email" class="form-control" value="{{ $item->email }}" id="recipient-name"  disabled   style="  border-bottom-color: #cccccc; color: black;">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">İstek/Şikayet:</label>
                                                        <textarea class="form-control"  id="message-text" rows="10" cols="10" disabled  style="border-bottom-color: #cccccc; color: black;">{{$item->message}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                        </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
   @endsection

