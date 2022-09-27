@extends('backend.layouts.app')
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
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#{{ $item->id }}" data-whatever="@getbootstrap">Görüntüle</button>
                                <div class="modal fade" id="{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{ $item->id }}">New message</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                        <textarea class="form-control" id="message-text"></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

