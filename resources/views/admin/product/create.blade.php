@extends('admin.layouts.master')

@section('title','Pizza Create Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href=" {{ route('product#listPage') }} "><button
                            class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Your Category</h3>
                        </div>
                        <hr>
                        <form action=" {{ route('product#create') }} " method="post" enctype="multipart/form-data"
                            novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Name</label>
                                <input name="pizzaName" type="text"
                                    class="form-control @error('pizzaName') is-invalid @enderror"
                                    value="{{ old('pizzaName') }}" placeholder="Pizza Name...">
                                @error('pizzaName')
                                <small class="invalid-feedback"> {{ $message }} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Category</label>
                                <select name="pizzaCategory"
                                    class="form-select @error('pizzaCategory') is-invalid @enderror  ">
                                    <option value="" disabled selected>Choose Your Category</option>
                                    @foreach ($categories as $category )
                                    <option value=" {{$category->id}} "> {{ $category->name}} </option>
                                    @endforeach
                                </select>
                                @error('pizzaCategory')
                                <small class="invalid-feedback"> {{ $message }} </small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="control-label mb-1">Description</label>
                                <textarea name="pizzaDescription" value="{{ old('pizzaDescription') }}" type="text"
                                    class="form-control @error('pizzaDescription') is-invalid @enderror "
                                    placeholder="Description..."></textarea>
                                @error('pizzaDescription')
                                <small class="invalid-feedback"> {{ $message }} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Image</label>
                                <input type="file" name="pizzaImage"
                                    class="form-control @error('pizzaImage') is-invalid @enderror">
                                @error('pizzaImage')
                                <small class="invalid-feedback"> {{ $message }} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Waiting Time</label>
                                <input type="text" name="waitingTime"
                                    class="form-control @error('waitingTime') is-invalid @enderror"
                                    placeholder="Waiting Time..." value="{{ old('waitingTime') }}">
                                @error('waitingTime')
                                <small class="invalid-feedback"> {{ $message }} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Price</label>
                                <input type="text" name="pizzaPrice"
                                    class="form-control @error('pizzaPrice') is-invalid @enderror"
                                    value="{{ old('pizzaPrice') }}" placeholder="Price...">
                                @error('pizzaPrice')
                                <small class="invalid-feedback"> {{ $message }} </small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
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
