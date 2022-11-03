@extends('user.layouts.master')

<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="">About</a>
                <a class="text-body mr-3" href="">Contact</a>
                <a class="text-body mr-3" href="">Help</a>
                <a class="text-body mr-3" href="">FAQs</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My
                        Account</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">Sign in</button>
                        <button class="dropdown-item" type="button">Sign up</button>
                    </div>
                </div>
                <div class="btn-group mx-2">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                        data-toggle="dropdown">USD</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">EUR</button>
                        <button class="dropdown-item" type="button">GBP</button>
                        <button class="dropdown-item" type="button">CAD</button>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                        data-toggle="dropdown">EN</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">FR</button>
                        <button class="dropdown-item" type="button">AR</button>
                        <button class="dropdown-item" type="button">RU</button>
                    </div>
                </div>
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle"
                        style="padding-bottom: 2px;">0</span>
                </a>
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle"
                        style="padding-bottom: 2px;">0</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
@section('content')


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="data-table">
                <thead class="thead-dark">
                    <th>Image</th>
                    <th>Products</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th class="col-3">Total</th>
                    <th>Remove</th>
                </thead>
                <tbody class="align-middle">
                    @foreach ($cartList as $c)
                    <tr>
                        <input type="hidden" name="" value="{{$c->pizza_price}}" id="price">
                        <input type="hidden" id="productId" class="productId" value="{{$c->product_id}}">
                        <input type="hidden" id="primaryId" class="primaryId" value="{{$c->id}}">
                        <td class="img-thumbnail"><img src="{{ asset('storage/'.$c->pizza_image)}}" alt=""
                                width="100px"></td>
                        <td class="align-middle">{{$c->pizza_name}}</td>
                        <input type="hidden" id="userId" value="{{$c->user_id}}">
                        <td class="align-middle" id="pizzaPrice"> {{ $c->pizza_price}}Kyats </td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 150px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary rounded-3 btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm rounded-2 border-0 text-center"
                                    id="qty" value="{{$c->qty}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary rounded-3 btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id="total">{{$c->pizza_price*$c->qty}} Kyats</td>
                        <td class="align-middle"><button class="btn btn-danger rounded-2 btn-remove"><i
                                    class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                    Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="sub-total">{{ $totalPrice }} Kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium">3000 Kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="final-price">{{ $totalPrice + 3000 }} Kyats</h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-2 rounded-2" id="orderBtn">Proceed To
                        Checkout</button>

                    <button class="btn btn-block btn-danger font-weight-bold my-3 py-2 rounded-2" id="clearBtn">Clear Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){

            // when plus btn click
            $('.btn-plus').click(function(){
                $parentNode = $(this).parents('tr');
                // $price = $parentNode.find('#price').val();
                $price = Number($parentNode.find('#pizzaPrice').html().replace('Kyats',''));
                // console.log($price);
                $qty = Number($parentNode.find('#qty').val());
                $total = $price * $qty;
                $parentNode.find('#total').html($total+"Kyats");

                summaryCalculation();


            });

            // when minus btn click
            $('.btn-minus').click(function(){
                $parentNode = $(this).parents('tr');
                $price = $parentNode.find('#price').val();
                $qty = Number($parentNode.find('#qty').val());
                $total = $price*$qty;

                if($qty == 0 ){
                   $('.btn-minus').attr('disabled');
                }
                $parentNode.find('#total').html($total +"Kyats");

                summaryCalculation();

            });

            // when cross-btn click
            $('.btn-remove').click(function (e) {
                e.preventDefault();
                $parentNode = $(this).parents('tr');
                $productId = $parentNode.find('.productId').val();
                $primaryId = $parentNode.find('.primaryId').val();
                // console.log($productId);
                $($parentNode).remove();

                $.ajax({
                    type: "get",
                    url: "/user/ajax/clear/current/product",
                    data: {'productId':$productId,'primaryId':$primaryId},
                    dataType: "json",
                });

                summaryCalculation();
            });


            function summaryCalculation() {
                $totalPrice = 0;
                $('#data-table tbody tr').each(function(index,row){
                $totalPrice += Number($(row).find('#total').text().replace('Kyats',''));
                });
                // console.log($totalPrice);
                $('#sub-total').html($totalPrice+"Kyats");
                $('#final-price').html($totalPrice+3000+"Kyats");
            }

            $('#orderBtn').click(function (e) {
                e.preventDefault();

                $orderList = [];
                $ramdomNo = Math.floor(Math.random() * 100000000001);
                console.log($ramdomNo);
                $('#data-table tbody tr').each(function (index,row) {
                    $orderList.push({
                        'user_id' : $(row).find('#userId').val(),
                        'product_id' : $(row).find('#productId').val(),
                        'qty' : $(row).find('#qty').val(),
                        'total': $(row).find('#total').text().replace('Kyats','')*1,
                        'order_code' : 'POS'+$ramdomNo
                    });
                });

                $.ajax({
                    type: "get",
                    url: "/user/ajax/order",
                    data: Object.assign({},$orderList),
                    dataType: "json",
                    success: function (response) {
                        if(response.status === 'true'){
                            window.location.href = "http://127.0.0.1:8000/user/homePage";
                        }
                    }
                });
            });

            // when clear btn click
            $('#clearBtn').click(function (e) {
                e.preventDefault();
                // console.log('clear');
                $('#data-table tbody tr').remove();
                $('#sub-total').html("0 Kyat");
                $('#final-price').html("3000 Kyat");

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/user/ajax/clear/cart",
                    data: "data",
                    dataType: "json",
                });

            });


        });
</script>
@endsection
