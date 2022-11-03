@extends('admin.layouts.master')


@section('title','Product List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->

               <div class="d-flex justify-content-between">
                    <a href="{{route('order#listPage')}}" class="fs-5"> <i class="fa-solid fa-arrow-left"></i>back </a>


                    <div class="card col-5 rounded shadow pt-4 px-2 mb-3">
                        <h2 class="ms-3"> <i class="fa-solid fa-clipboard"></i> Order Info</h2>
                        <div class="card-body p-4">
                            <div class="row mb-2">
                                <div class="col"> <i class="fa-solid fa-user me-2"></i>Customer Name</div>
                                <div class="col"><b>{{ strtoupper($orderList[0]->user_name) }}</b></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col"> <i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                <div class="col"><b>{{$orderList[0]->order_code}}</b></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col"> <i class="fa-solid fa-clock me-2"></i>Order Date</div>
                                <div class="col"><b>{{$orderList[0]->created_at->format('d-M-Y ( D )')}}</b></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col"> <i class="fa-solid fa-money-bill-wave me-2"></i>Total</div>
                                <div class="col"><b>{{$order->total_price}} Kyats</b></div>
                            </div>
                            <small class="text-info"><i class="fa-regular fa-bell"></i> Include Delivery Charges(3000Kyats)</small>

                        </div>
                    </div>
               </div>


                <div class="table-responsive table-responsive-data2 mt-4">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Quatity</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderList as $list)
                                <tr class="tr-shadow">
                                    <td></td>
                                    <td class="text-center">{{ $list->id }}</td>
                                    <td> <img src="{{ asset('storage/'.$list->product_image) }}" style="width: 200px;height:150px" class="img-thumbnail shadow"></td>
                                    <td>{{ $list->product_name }}</td>
                                    <td>{{ $list->created_at->format('j-M-Y') }}</td>
                                    <td class="text-center">{{ $list->qty }}</td>
                                    <td class="text-end text-dark">{{ $list->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

