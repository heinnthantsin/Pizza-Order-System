@extends('user.layouts.master');

@section('content')
<div class="d-flex flex-column align-items-center" style="width: 100%;">
    <h1 class="text-center mb-4">Contact Form</h1>
        <div class="card rounded-4 p-5" style="background: rgba(233, 229, 8, 0.26); width:1000px;">
            <form action="{{route('user#sendMessage')}}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-6">
                        <label for="name" class="text-dark">Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror rounded-2 shadow" value="{{Auth::user()->name}}" placeholder="Name...">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-6" >
                        <label for="email" class="text-dark">Email</label>
                        <input type="email" id="email" name="email" class="form-control rounded-2 @error('email') is-invalid @enderror shadow"value="{{Auth::user()->email}}" placeholder="Email...">
                    </div>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row mb-4">
                    <label for="message" class="text-dark">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control @error('message') is-invalid @enderror rounded-2 shadow shadow" placeholder="Write A Message...."></textarea>
                    @error('message')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row">
                    <button type="submit" class="btn btn-outline-dark rounded-2 shadow">Send</button>
                </div>

            </form>
        </div>
</div>
@endsection
