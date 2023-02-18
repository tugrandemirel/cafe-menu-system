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
        </div>
        <div class="row pt-4">

            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @foreach($menus as $menu)
                            <a class="nav-item nav-link  @if($loop->first) active @endif" id="nav-{{$menu->id}}-tab" data-toggle="tab" href="#nav-{{$menu->id}}" role="tab" aria-controls="nav-{{$menu->id}}" aria-selected="true">{{$menu->name}}</a>
                        @endforeach
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    @foreach($menus as $menu)
                        <div class="tab-pane fade @if($loop->first) show active @endif" id="nav-{{$menu->id}}" role="tabpanel" aria-labelledby="nav-{{$menu->id}}-tab">
                            @foreach($menu->submenus as $submenu)
                                <div class="row">
                                    @foreach($submenu->subproducts as $product)
                                        <div class="input-group mt-2 col-md-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="">{{ $product->name }}</span>
                                            </div>
                                                <input type="number" name="quantity" id="" class="form-control product" >
                                                <input type="hidden" name="id" value="{{ $product->id }}" class="form-control id" >
                                                <input type="hidden" name="price" value="{{ $product->price }}" class="form-control price" >
                                                <button class="btn btn-primary addProduct" type="button" id="button-addon2">Ekle</button>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-12 pt-4">
                <table class="table table-bordered " id="mydiv">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ürün Adı</th>
                        <th scope="col">Ürün Adedi</th>
                        <th scope="col">Fiyat</th>
                    </tr>
                    </thead>
                    <tbody >
                    @if(isset($desk->adicional))
                       @foreach( $desk->adicional->adicionalProduct as $adicionalProduct)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $adicionalProduct->product->name }}</td>
                            <td>{{ $adicionalProduct->quantity }}</td>
                            <td>{{ $adicionalProduct->product->price }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th scope="row">3</th>
                            <td>Toplam Tutar</td>
                            <td colspan="2" class="text-end">{{ $adicionalProduct->sum('price') }}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td colspan="2" class="text-end">
                                <button type="submit" onclick="document.getElementById('myForm').submit();"  class="btn btn-primary">Ödeme Yap</button>
                            </td>
                            <form id="myForm" method="POST" action="{{ route('admin.desks.pay', ['desk'=> $desk->id]) }}">
                                <input type="hidden" name="desk_id" value="{{ $desk->id }}">
                                @csrf
                            </form>
                        </tr>
                    @else
                        <tr>
                            <th scope="row">1</th>
                            <td colspan="3" class="text-center">Ürün Eklenmedi</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
    </div>
@endsection
@section('scripts')
            <script>

                $('.addProduct').click(function (){
                    const product = $(this).parent().find('.product').val();
                    const product_id = $(this).parent().find('.id').val();
                    const price = $(this).parent().find('.price').val();
                    $.ajax({
                        type: "POST",
                        url:'{{ route("admin.desks.store", ["desk"=> $desk]) }}',
                        data: {
                            quantity: product,
                            product_id: product_id,
                            price: price,
                            // quantity: quantity,
                            desk: {{$desk->id}},
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            $("#mydiv").load(location.href + " #mydiv");
                        }
                    });

                })

             {{--$('.addProduct').click(function () {--}}
             {{--    const product = $(this).parent().find('.product').val();--}}
             {{--    const id = $(this).parent().find('.id').val();--}}
             {{--    const price = $(this).parent().find('.price').val();--}}
             {{--    $.ajax({--}}
             {{--        type: "POST",--}}
             {{--        url:'{{ route("admin.desks.store", ["desk"=> $desk]) }}',--}}
             {{--        data: {--}}
             {{--            product: product,--}}
             {{--            id: id,--}}
             {{--            price: price,--}}
             {{--            desk: {{$desk}},--}}
             {{--            _token: '{{ csrf_token() }}'--}}
             {{--        },--}}
             {{--        success: function (data) {--}}
             {{--            console.log(data);--}}
             {{--        }--}}
             {{--    });--}}
             {{--});--}}
            </script>
@endsection
