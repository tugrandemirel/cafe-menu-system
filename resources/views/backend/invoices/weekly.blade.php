@extends('backend.layouts.app')
@section('site_name', 'Haftalık Faturalar')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Haftalık Faturalar</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Masa Numarası</th>
                        <th scope="col">Kazanç</th>
                        <th scope="col">Tarih</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($adicionales) && count($adicionales) > 0)
                            <?php $total_price = 0; ?>
                        @foreach($adicionales as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$item->desk->number}}</td>
                                <td>{{$item->adicionalProduct->sum('price')}}</td>

                                    <?php $total_price += $item->adicionalProduct->sum('price') ?>
                                <td>{{$item->created_at->format('Y-m-d H:i')}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th scope="row">#</th>
                            <td>Toplam Tutar</td>
                            <td colspan="2" class="text-end">{{ $total_price }}</td>
                        </tr>
                    @else
                        <tr>
                            <th scope="row">#</th>
                            <td colspan="3" class="text-center">Fatura Bulunamadı</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
