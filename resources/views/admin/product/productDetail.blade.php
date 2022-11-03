@extends('admin.layouts.master')

@section('title','Detail Pizza Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content ms-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid ms-5">
            <div class="ms-5">
                <div class="card shadow-lg rounded-3">
                    <div class="card-body col-12">
                        <i class="fa-solid fa-arrow-left m-1 text-dark fs-4" onclick="history.back()"></i>
                        @if(session('updateSuccess'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{ session('updateSuccess') }}
                            <button class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                        @endif
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-1">
                                <div class="image" style="min-width: 230px; border:5px solid #ddd;">
                                    <img src=" {{ asset('storage/'.$pizza->image) }} ">
                                </div>
                            </div>
                            <div class="col-7 offset-1">
                                <h2 class="text-capitalize  fs-3"> {{ $pizza->name }} </h2>
                                <span class="my-2  btn btn-info" title="price"> <i class="fa-solid fa-dollar me-2 text-dark"></i> {{ $pizza->price }} </span>
                                <span class="my-2  btn btn-info" title="waiting time"> <i class="fa-solid fa-clock me-2 text-dark"></i>{{ $pizza->waiting_time}} </span>
                                <span class="my-2   btn btn-info" title="view-count"> <i class="fa-solid fa-eye  me-2 text-dark"></i> {{ $pizza->view_count }} </span>
                                <span class="my-2  btn btn-info" title="started date"> <i class="fa-solid fa-calendar-days me-2 text-dark"></i>{{ $pizza->created_at->format('j - M - Y') }} </span>
                                <span class="my-2  btn btn-info" title="category"> <i class="fa-solid fa-list me-2 text-dark"></i> {{ $pizza->category_name }} </span>
                                <div class="my-2 card-body text-light shadow rounded-2 bg-info" title="description"> <i class="fa-solid fa-file-lines fs-1 me-2 text-dark"></i>{{ $pizza->description }} </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-6 offset-3">
                                <a href=" {{ route('product#editPage',$pizza->id) }} "
                                    class="btn btn-outline-dark d-block rounded-3 shadow"> <i
                                        class="fa-solid fa-edit me-3"></i>Edit Pizza </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
