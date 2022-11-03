@extends('layouts.master')

@section('title','Login Page')

@section('content')

    <div class="login-form">
        <form action=" {{ route('login') }} " method="POST">
            @csrf

            @error('terms')
            <small class="text-danger"> {{ $message }} </small>
            @enderror

            <div class="form-group mb-4">
                <label>Email Address</label>
                <input name="email" class="au-input au-input--full" type="email" placeholder="Email"  autocomplete="off">
                @error('email')
                   <div class="text-danger">
                     {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="form-group mb-4">
                <label>Password</label>
                <input name="password" class="au-input au-input--full" type="password"  placeholder="Password" autocomplete="off">
                @error('password')
                    <div class="text-danger ">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href=" {{ route('auth#registerPage') }} ">Sign Up Here</a>
            </p>
        </div>
    </div>

@endsection
