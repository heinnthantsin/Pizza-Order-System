@extends('admin.layouts.master')


@section('title','Order List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <a href=" {{ route('order#listPage') }} ">
                                <h1 class="title-1 fs-1">Order List</h1>
                            </a>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <h3>Search Key : <span class="text-danger">{{ request('key') }}</span></h3>
                        <small>Role - {{ Auth::user()->role }} </small>
                        <h4> Total : {{  count($order) }} </h4>
                    </div>

                    <div class="col-3 offset-6">
                        <form action=" {{ route('product#listPage') }} " method="get">
                            @csrf
                            <div class="input-group shadow-sm">
                                <input type="text" name="key" class="form-control" placeholder="Search..."
                                    value="{{ request('key') }}">
                                <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>

                <form action="{{route("order#changeStatus")}}" method="GET" class="float-end">
                    <div class="input-group">
                        @csrf
                        <select name="orderStatus" class="ms-4 fs-6 bg-white border-0 py-2 px-3">
                            <option value="">All</option>
                            <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                            <option value="1" @if (request('orderStatus') == '1') selected @endif>Success</option>
                            <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                        </select>
                        <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                    </div>
            </form>


            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Order Code</th>
                            <th>Total Amount</th>
                            <th>Order Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                        @foreach ($order as $o)
                        <tr class="tr-shadow">
                            <input type="hidden" class="orderId" value="{{ $o->id }}">
                            <td>{{$o->user_id}}</td>
                            <td>{{$o->user_name}}</td>
                            <td><a href="{{route('order#listInfo',$o->order_code)}}">{{$o->order_code}}</a></td>
                            <td class="amount">{{$o->total_price}} Kyats</td>
                            <td>{{$o->created_at->format('d/M/Y')}}</td>
                            <td>
                                <select class="form-select-sm text-muted statusChange">
                                    <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                    <option value="1" @if ($o->status == 1) selected @endif>Success</option>
                                    <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <span class="btn btn-outline-dark rounded-4 float-end mt-2"> Total : {{ count($order) }} </span>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function () {

            //change status
            $('.statusChange').change(function (e) {
                e.preventDefault();
                // console.log($(this).val());
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();
                // console.log($orderId);

                $data = {
                    'orderId' : $orderId,
                    'status' : $currentStatus,
                }

                $.ajax({
                    type: "get",
                    url: "/order/ajax/status/change",
                    data: $data,
                    dataType: "json",
                });
            });

        });
    </script>
@endsection

