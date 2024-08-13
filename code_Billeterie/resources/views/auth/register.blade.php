@extends('layouts.auth')
@section('title')
    {{ __('Inscription') }}
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
@endsection

@section('content')
    <h2 class="text-2xl font-bold mb-6">S'inscrire</h2>
    <form id="signup-form" method="POST" action="{{ route('register') }}" class="login-form" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="last-name">Nom</label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="last-name" name="lastname" value="{{ old('lastname') }}" type="text" placeholder="Nom" required>
            @error('lastname')
                <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="first-name">Prénom</label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="first-name" name="firstname" value="{{ old('firstname') }}" type="text" placeholder="Prénom"
                required>
            @error('firstname')
                <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Nom d'utilisateur</label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="username" name="username" type="text" placeholder="Nom d'utilisateur" value="{{ old('username') }}"
                required>
            @error('username')
                <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="email" name="email" type="email" placeholder="Adresse email" value="{{ old('email') }}"
                required>
            @error('email')
                <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone Number</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="phone" type="tel" name="phone_number">
                <input type="hidden" id="country-code" name="country_code">

                <br>
            </div>
            @error('phone_number')
                    <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                        {{ $message }}
                    </div>
            @enderror


        </div>

        <div class="mb-4 relative">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Mot de passe</label>
            <div class="relative">
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                    id="password" name="pass" type="password" value="{{ old('pass') }}" placeholder="Mot de passe"
                    required>
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-700"
                    onclick="togglePasswordVisibility('password', this)">
                    <i class="fas fa-eye"></i>
                </button>
                @error('pass')
                    <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-4 relative">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="repeat-password">Confirmation du mot de
                passe</label>
            <div class="relative">
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                    id="repeat-password" name="pass_confirmation" type="password" placeholder="Confirmation du mot de passe"
                    required>
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-700"
                    onclick="togglePasswordVisibility('repeat-password', this)">
                    <i class="fas fa-eye"></i>
                </button>
                @error('pass_confirmation')
                    <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox text-blue-600" id="terms">
                <span class="ml-2 text-gray-700">J'accepte les <a href="#" class="text-blue-600 underline">Conditions
                        d'utilisation</a></span>
            </label>
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                S'inscrire
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800"
                href="{{ route('login') }}">
                Se connecter
            </a>
        </div>
    </form>
    </div>
@endsection

@section('scripts')
@endsection
