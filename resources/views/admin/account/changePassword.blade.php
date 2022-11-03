@extends('admin.layouts.master')

@section('title','Change Password Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form action=" {{ route('admin#changePassword') }} " method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="oldPassword" class="control-label mb-1">Enter Old Password</label>
                                <input id="oldPassword" name="oldPassword" type="text" class="form-control
                                  @error('oldPassword') is-invalid @enderror
                                   @if (session('notMatch')) is-invalid @endif  "
                                    value=" {{ old('oldPassword') }} " placeholder="Old Password...">
                                @error('oldPassword')
                                <small class="invalid-feedback"> {{ $message }} </small>
                                @enderror

                                @if (session('notMatch'))
                                    <div class="invalid-feedback">
                                        {{ session('notMatch') }}
                                    </div>
                                @endif


                            </div>

                            <div class="form-group">
                                <label for="newPassword" class="control-label mb-1">Enter New Password</label>
                                <input id="newPassword" name="newPassword" type="text" class="form-control @error('newPassword')
                                                                    is-invalid
                                                                @enderror "
                                    value=" {{ old('newPassword') }} " placeholder="New Password...">
                                @error('newPassword')
                                <small class="text-danger"> {{ $message }} </small>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label for="confirmPassword" class="control-label mb-1">Enter Confirm Password</label>
                                <input id="confirmPassword" name="confirmPassword" type="text" class="form-control @error('confirmPassword')
                                                                    is-invalid
                                                                @enderror " aria-required="true" aria-invalid="false"
                                    value=" {{ old('confirmPassword') }} " placeholder="Seafood...">
                                @error('confirmPassword')
                                <small class="text-danger"> {{ $message }} </small>
                                @enderror

                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Change Password</span>
                                    <i class="fa-solid fa-key"></i>
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
