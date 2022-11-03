@extends('user.layouts.master')

@section('content')
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                    by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div
                        class="d-flex align-items-center justify-content-between mb-3 bg-dark shadow-sm text-white p-2">
                        <label class="">Category</label>
                        <span class="badge border font-weight-bolder p-2">{{count($category)}}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="{{route('user#homePage')}}" class="text-dark"><label class="">All</label></a>
                    </div>
                    @foreach ($category as $c)
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="{{route('user#filter',$c->id)}}" class="text-dark" ><label class=""> {{ $c->name }} </label></a>
                    </div>
                    @endforeach
                </form>
            </div>
            <!-- Price End -->
            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a href="{{route('user#history')}}" class="btn btn-dark position-relative rounded-2 px-2">
                                <i class="fas fa-history text-white"></i> History
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($history) }}
                                </span>
                            </a>

                            <a href="{{route('user#cartList')}}" class="btn btn-dark rounded-2 position-relative">
                                <i class="fas fa-shopping-cart text-white"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($cart) }}
                                </span>
                            </a>
                        </div>
                        {{-- alert message --}}
                        @if(session('successSend'))
                        <div class="">
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="fa solid fa-check"></i> {{ session('successSend') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        </div>
                        @endif
                        <div class="ml-2">
                            <select name="sorting" id="sortingOption" class="form-select">
                                <option class="bg-dark text-white"  value="">Choose One Option</option>
                                <option class="bg-dark text-white" value="asc">Ascending</option>
                                <option class="bg-dark text-white" value="desc">Descending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <span id="data-list" class="row">
                    @if (count($pizza) != 0)
                        @foreach ($pizza as $p)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4" id="my-form">
                                <div class="product-img position-relative overflow-hidden" style="height: 250px;">
                                    <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image)}}" alt="">
                                    <div class="product-action">
                                        {{-- <a class="btn btn-outline-dark btn-square" href="" class="addToCart"><i class="fa fa-shopping-cart"></i></a> --}}
                                        <a class="btn btn-outline-dark btn-square" href="{{route('user#details',$p->id)}}"><i class="fa fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href=""> {{$p->name}} </a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{$p->price}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center shadow fs-2 col-8 offset-2 p-3 rounded-3 mt-5">
                            There is no pizza in this category <i class="fa-solid fa-pizza-slice"></i>
                        </div>
                    @endif
                </span>

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@stop

@section('scriptSource')
<script>
    $(document).ready(function () {

            $('#sortingOption').change(function(){
                $eventOpt = $('#sortingOption').val();
                // console.log($eventOpt);
                        if($eventOpt == "asc"){
                            $.ajax({
                                type: "get",
                                url: "/user/ajax/pizza/list",
                                data: {'status':'asc'},
                                dataType: "json",
                                success: function (response) {
                                   $list = '';
                                    for($i=0 ;$i<response.length; $i++){
                                        // console.log(`${response[$i].name}`)
                                        $list += `
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                            <div class="product-item bg-light mb-4" id="my-form">
                                                <div class="product-img position-relative overflow-hidden" style="height: 250px;">
                                                    <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}')}}" alt="">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                                class="fa fa-shopping-cart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-circle-info"></i></a>
                                                    </div>
                                                </div>

                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name} </a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        <h5>${response[$i].price}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        `;
                                    }
                                    $('#data-list').html($list);
                                }
                            });
                        }else if($eventOpt == "desc"){
                            $.ajax({
                                type: "get",
                                url: "/user/ajax/pizza/list",
                                data: {'status':'desc'},
                                dataType: "json",
                                success: function (response) {
                                    $list = "";
                                    for($i=0; $i < response.length; $i++){
                                        $list += `
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                            <div class="product-item bg-light mb-4" id="my-form">
                                                <div class="product-img position-relative overflow-hidden" style="height: 250px;">
                                                    <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}')}}" alt="">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                                class="fa fa-shopping-cart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-circle-info"></i></a>
                                                    </div>
                                                </div>

                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name} </a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        <h5>${response[$i].price}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        `;
                                    }
                                    $('#data-list').html($list);
                                }
                            });
                        }
            });

            $('.addToCart').click(function (e) {
                e.preventDefault();
            });
        });
</script>
@endsection
