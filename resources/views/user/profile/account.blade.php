@extends('user.layouts.master')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center title-2 py-3 rounded-3 shadow-sm fw-bold"
                                style="font-size:1.5rem; border:1px solid #ddd;">{{Auth::user()->name}} Profile
                            </h1>

                            @if (session('successChange'))
                                <div class="alert alert-primary col-10 offset-1 alert-dismissible fade show">
                                    {{ session('successChange') }}
                                    <button type="button" class="btn-close float-end fs-5" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                        </div>
                        <hr>
                        <form action="{{route('user#accountChange',Auth::user()->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-5">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'female')
                                        <img src="{{ asset('image/default_profile2.jpg') }}" class="img-thumbnail shadow-sm"
                                            alt="">
                                        @else
                                        <img src="{{ asset('image/default_profile.jpg') }}" class="img-thumbnail shadow-sm"
                                            alt="">
                                        @endif
                                    @else
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow" alt="$fileName" />
                                    @endif

                                    <div>
                                        <input type="file" name="image"
                                            class="form-control shadow rounded my-3 @error('image') is-invalid  @enderror">
                                        @error('image')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-block shadow rounded btn-outline-dark py-1">
                                            <span style="font-size: 1.1rem;">Update</span>
                                            <i class="fa-solid fa-pen ms-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Enter Name</label>
                                        <input name="name" type="text"
                                            class="form-control  shadow rounded @error('name') is-invalid @enderror "
                                            value=" {{ old('name',Auth::user()->name) }} " placeholder="Name...">
                                        @error('name')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="control-label mb-1">Enter Email</label>
                                        <input name="email" type="text"
                                            class="form-control  shadow rounded @error('email') is-invalid @enderror "
                                            value=" {{ old('email',Auth::user()->email) }} " placeholder="Email...">
                                        @error('email')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="control-label mb-1">Enter Phone</label>
                                        <input name="phone" type="text"
                                            class="form-control  shadow rounded @error('phone') is-invalid @enderror "
                                            placeholder="phone..." value=" {{ old('phone',Auth::user()->phone) }} ">
                                        @error('phone')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="gender" class="control-label mb-1">Enter gender</label>
                                        <select name="gender" class="form-control  shadow rounded @error('phone') is-invalid @enderror">
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif >Male</option>
                                            <option value="female" @if(Auth::user()->gender == "female") selected @endif >Female</option>
                                            <option value="gay" @if(Auth::user()->gender == "gay") selected @endif>Gay</option>
                                        </select>
                                        @error('phone')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="control-label mb-1">Enter Address</label>
                                        <textarea name="address" id="address" class="form-control  shadow rounded" cols="30" rows="5"
                                            placeholder="Enter Address"
                                            value="">{{ old('address',Auth::user()->address) }} </textarea>
                                        @error('address')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <input type="test" name="role" class="form-control  shadow rounded"
                                            value="{{ old('role',Auth::user()->role)  }}" disabled>
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
