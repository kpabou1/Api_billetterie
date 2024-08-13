@extends('layouts.auth')
@section('title')
{{__('Login Admin Panel')}}
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{ asset(env('LOGO_PATH')) }}" alt="IMG" class="img-fluid">
            </div>
        </div>
    </div>
</div>




<div class="login-container">
    <div class="login-image">
        <!-- Your image code goes here -->
    </div>
    <x-auth-session-status class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert" :status="session('status')" />
    <div class="p-lg-5 p-4">
        <h5 class="text-primary">Forgot Password?</h5>
        <p class="text-muted">Reset password with velzon</p>

        <div class="mt-2 text-center">
            <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c"
                class="avatar-xl">
            </lord-icon>
        </div>

        <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
            Enter your email and instructions will be sent to you!
        </div>
        <div class="p-2">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control"  name="email" value="{{ old('email') }}" id="email" placeholder="Enter email address">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />


                <div class="text-center mt-4">
                    <button class="btn btn-success w-100" type="submit">Send Reset
                        Link</button>
                </div>
            </form><!-- end form -->
        </div>

        <div class="mt-5 text-center">
            <p class="mb-0">Wait, I remember my password... <a href="{{ route('login') }}"
                    class="fw-semibold text-primary text-decoration-underline"> Click
                    here </a> </p>
        </div>
    </div>

</div>


@endsection