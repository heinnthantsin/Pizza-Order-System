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
                            <h1 class="text-center title-2 py-3 rounded-3 shadow-sm fw-bold"
                                style="font-size:1.5rem; border:1px solid #ddd;">{{$account->name}} Change Role Page
                            </h1>
                        </div>
                        <hr>
                        <form action="{{ route('admin#changeRole',$account->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-5">
                                    @if ($account->image == null)
                                    @if ($account->gender == 'female')
                                    <img src="{{ asset('image/default_profile2.jpg') }}" class="img-thumbnail shadow-sm"
                                        alt="">
                                    @else
                                    <img src="{{ asset('image/default_profile.jpg') }}" class="img-thumbnail shadow-sm"
                                        alt="">
                                    @endif
                                    @else
                                    <img src=" {{ asset('storage/'.$account->image) }} "
                                        class="img-thumbnail shadow-sm" alt="$fileName" />
                                    @endif

                                    <div>
                                        <input type="file" name="image"
                                            class="form-control my-3 @error('image') is-invalid  @enderror">
                                        @error('image')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-block shadow btn-outline-dark py-1">
                                            <span style="font-size: 1.1rem;">Update</span>
                                            <i class="fa-solid fa-pen ms-2"></i>
                                        </button>
                                    </div>

                                    <div>
                                        <a type="submit" onclick="history.back()" class="btn btn-block shadow btn-outline-dark py-1 mt-3">
                                            <i class="fa-solid fa-arrow-left ms-2"></i>
                                            <span style="font-size: 1.1rem;" class="text-dark">Back</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select name="role" id="" class="form-select ">
                                            <option value="admin" @if($account->role == 'admin') selected @endif >Admin</option>
                                            <option value="user" @if($account->role == 'user') selected @endif >User</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Enter Name</label>
                                        <input name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror "
                                            value=" {{ old('name',$account->name) }} " placeholder="Name...">
                                        @error('name')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="control-label mb-1">Enter Email</label>
                                        <input name="email" type="text"
                                            class="form-control @error('email') is-invalid @enderror "
                                            value=" {{ old('email',$account->email) }} " placeholder="Email...">
                                        @error('email')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="control-label mb-1">Enter Phone</label>
                                        <input name="phone" type="text"
                                            class="form-control @error('phone') is-invalid @enderror "
                                            placeholder="phone..." value=" {{ old('phone',$account->phone) }} ">
                                        @error('phone')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="gender" class="control-label mb-1">Enter gender</label>
                                        <select name="gender" class="form-control @error('phone') is-invalid @enderror">
                                            <option value=" {{ old('male',$account->gender) }} " @if ($account->
                                                gender == 'male') selected @endif >Male</option>
                                            <option value=" {{ old('female',$account->gender) }} "
                                                @if($account->gender == "female") selected @endif >Female</option>
                                            <option value="{{ old('gay',$account->gender) }}" @if($account->
                                                gender == "gay") selected @endif>Gay</option>
                                        </select>
                                        @error('phone')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="control-label mb-1">Enter Address</label>
                                        <textarea name="address" id="address" class="form-control" cols="30" rows="5"
                                            placeholder="Enter Address"
                                            value="">{{ old('address',$account->address) }} </textarea>
                                        @error('address')
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
