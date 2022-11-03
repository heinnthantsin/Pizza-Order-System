@extends('admin.layouts.master')

@section('title','Change Password Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-2 p-3">
                <div class="card shadow-lg p-3 rounded-3">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 py-2 fs-3 shadow rounded-3">Account Info</h3>
                        </div>
                        @if(session('updateSuccess'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                {{ session('updateSuccess') }}
                        <button class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                        @endif
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-2">
                                <div class="image" style="width: 280px; border:5px solid #ddd;">
                                    @if (Auth::user()->image === null)
                                        @if (Auth::user()->gender == 'female')
                                        <img src="{{ asset('image/default_profile2.jpg') }}" class="img-thumbnail shadow-sm" alt="">
                                        @else
                                        <img src="{{ asset('image/default_profile.jpg') }}" class="img-thumbnail shadow-sm" alt="">
                                        @endif
                                    @else
                                    <img src=" {{ asset('storage/'.Auth::user()->image) }} " alt="$fileName" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-4 offset-2">
                                <h4 class="my-3"> <i class="fa-solid fa-user-pen me-2"></i> {{ Auth::user()->name }} ({{ Auth::user()->role }}) </h4>
                                <h4 class="my-3"> <i class="fa-solid fa-envelope me-2"></i> {{ Auth::user()->email }} </h4>
                                <h4 class="my-3"> <i class="fa-solid fa-address-card me-2"></i> {{ Auth::user()->address }} </h4>
                                <h4 class="my-3"> <i class="fa-solid fa-phone me-2"></i> {{ Auth::user()->phone }} </h4>
                                <h4 class="my-3"> <i class="fa-solid fa-mars-and-venus  me-2"></i> {{ Auth::user()->gender }} </h4>
                                <h4 class="my-3"> <i class="fa-solid fa-user-clock me-2"></i> {{ Auth::user()->created_at->format('j-M-Y') }} </h4>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-6 offset-3">
                                <a href=" {{ route('admin#editPage') }} " class="btn btn-outline-dark d-block rounded-3 shadow"> <i class="fa-solid fa-edit me-3"></i>Edit Profile </a>
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
