@extends('layouts.auth')
@section('title')
{{ __('Connexion') }}
@endsection

@section('content')

    <h2 class="text-2xl font-bold mb-6">Connectez-vous pour continuer</h2>
    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="full-name">Nom d'utilisateur/e-mail</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="full-name" type="text" name="input_type" placeholder="Nom d'utilisateur ou e-mail">
            @error('username')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4 relative">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Mot de passe</label>
            <div class="relative">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10" id="password" type="password" placeholder="Mot de passe" name="password">
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-700" onclick="togglePasswordVisibility('password', this)">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox text-blue-600" id="terms">
                <span class="ml-2 text-gray-700">Souviens-toi de moi</span>
            </label>
            <br><br>
            <a href="{{ route('password.request') }}" class="text-blue-600 underline">Mot de passe oublié ?</a>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Se connecter
            </button>
            <a  class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800" href="{{ route('register') }}">
                S'inscrire
            </a>
        </div>

    </form>

    <script>
        function togglePasswordVisibility(passwordFieldId, toggleButton) {
            var passwordField = document.getElementById(passwordFieldId);
            var icon = toggleButton.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

@endsection
