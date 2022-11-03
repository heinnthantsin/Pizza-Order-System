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
<div class="container-fluid" style="height: 500px;">
    <div class="row px-xl-5">
        <div class="col-lg-8 offset-2 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover table-striped text-center mb-0" id="data-table">
                <thead class="thead-dark">
                    <th>Date</th>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </thead>
                <tbody class="align-middle">
                    @foreach ($order as $o)
                        <tr>
                            <td class="align-middle">{{$o->created_at->diffForHumans()}}</td>
                            <td class="align-middle">{{$o->order_code}}</td>
                            <td class="align-middle">{{$o->total_price}}</td>
                            <td class="align-middle">
                                @if ($o->status == 0)
                                <span class="text-info"> <i class="fa-solid fa-clock me-1"></i> Pending...</span>
                                @elseif ($o->status == 1)
                                <span class="text-success"> <i class="fa-solid fa-check me-1"></i>Success</span>
                                @elseif ($o->status == 2)
                                <span class="text-danger"> <i class="fa-solid fa-warning me-1"></i>Reject</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{$order->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
