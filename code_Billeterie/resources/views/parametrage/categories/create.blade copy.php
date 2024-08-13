@extends('layouts.app')

@section('title', __('Create User'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Create User')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{__('Users')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Create User')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="firstname">{{ __('First Name') }}</label>
                    <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror"
                        required>
                    @error('firstname')
                    <x-input-error :message="$message" />
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="lastname">{{ __('Last Name') }}</label>
                    <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror"
                        required>
                    @error('lastname')
                    <x-input-error :message="$message" />
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="datenaiss">{{ __('Date of Birth') }}</label>
                    <input type="date" name="datenaiss" class="form-control @error('datenaiss') is-invalid @enderror"
                        required>
                    @error('datenaiss')
                    <x-input-error :message="$message" />
                    @enderror


                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="telephone">{{ __('Telephone') }}</label>
                    
                        <input type="tel" id="phone" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                        required>
                    @error('telephone')
                    <x-input-error :message="$message" />
                    @enderror
                </div>
                <script>
        // Initialisez le champ de numéro de téléphone avec la bibliothèque intl-tel-input
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "{{ asset('assets/libs/intl-tel-input/js/utils.js') }}"
        });
    </script>

                <div class="form-group col-md-4">
                    <label for="sexe">{{ __('Sexe') }}</label>
                    <select name="sexe" class="form-control @error('sexe') is-invalid @enderror" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @error('sexe')
                    <x-input-error :message="$message" />
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="email">{{ __('Email') }}</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <x-input-error :message="$message" />
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="avatar">{{ __('Avatar') }}</label>
                    <input type="file" name="avatar" class="form-control-file @error('avatar') is-invalid @enderror">
                    @error('avatar')
                    <x-input-error :message="$message" />
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="username">{{ __('Username') }}</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                        required>
                    @error('username')
                    <x-input-error :message="$username" />
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        required>
                    @error('password')
                    <x-input-error :message="$message" />
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Create User') }}</button>
        </form>
    </div>
</div>

@endsection