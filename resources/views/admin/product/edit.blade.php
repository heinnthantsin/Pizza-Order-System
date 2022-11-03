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
                        <i class="fa-solid fa-arrow-left text-dark fs-4" onclick="history.back()"></i>
                        <form action="{{route('product#updatePizza')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-5">
                                    <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                    <img src=" {{ asset('storage/'.$pizza->image) }} " class="img-thumbnail shadow-sm"
                                        alt="$fileName" />
                                    <div>
                                        <input type="file" name="pizzaImage" class="form-control my-3 @error('pizzaImage') is-invalid @enderror">
                                        @error('pizzaImage')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-block shadow btn-outline-dark py-1">
                                            <span style="font-size: 1.1rem;">Update</span>
                                            <i class="fa-solid fa-pen ms-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Enter Name</label>
                                        <input name="pizzaName" type="text"
                                            class="form-control @error('pizzaName') is-invalid @enderror "
                                            value=" {{ old('pizzaName',$pizza->name) }} " placeholder="Name...">
                                        @error('pizzaName')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price" class="control-label mb-1">Enter Price</label>
                                        <input name="pizzaPrice" type="text"
                                            class="form-control @error('pizzaPrice') is-invalid @enderror "
                                            value=" {{ old('pizzaPrice',$pizza->price) }} " placeholder="Price...">
                                        @error('pizzaPrice')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="waitingTime" class="control-label mb-1">Enter Waiting Time</label>
                                        <input name="waitingTime" type="text"
                                            class="form-control @error('waitingTime') is-invalid @enderror "
                                            placeholder="waitingTime..." value=" {{ old('waitingTime',$pizza->waiting_time) }} ">
                                        @error('waitingTime')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category" class="control-label mb-1">Choose category</label>
                                        <select name="pizzaCategory" class="form-control @error('phone') is-invalid @enderror">
                                           @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if($pizza->id == $category->id) selected  @endif> {{ $category->name }} </option>
                                           @endforeach
                                        </select>
                                        @error('pizzaCategory')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="control-label mb-1">Enter Description</label>
                                        <textarea name="pizzaDescription" id="description" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30" rows="5"
                                            placeholder="Enter description" value="">{{ old('pizzaDescription',$pizza->description) }}
                                        </textarea>
                                        @error('pizzaDescription')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

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
