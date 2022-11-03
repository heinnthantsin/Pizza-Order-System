@extends('admin.layouts.master')

@section('title','Category Create Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Your Category</h3>
                            </div>
                            <hr>
                            <form action="{{ route('category#createItem') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="categoryName" class="control-label mb-1">Name</label>
                                    <input id="categoryName" name="categoryName" value="{{ old('categoryName') }}" type="text" class="form-control @error('categoryName')  is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Category ..." >
                                        @error('categoryName')
                                            <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror

                                </div>

                                <div>
                                    <a href="{{route('categroy#listPage')}}" class="btn btn-dark my-3">
                                        <i class="fa-solid fa-arrow-left"></i>
                                        <span id="payment-button-amount">Back</span>
                                    </a>

                                    <button id="payment-button" style="float: right;"  type="submit" class="btn btn-info my-3">
                                        <span id="payment-button-amount">Create</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
