@extends('layouts.app')

@section('title', __('Ajouter un utilisateur'))

@section('content')

<!-- Début du titre de la page -->
<ul class="flex space-x-2 rtl:space-x-reverse">
    <li>
        <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <a href="{{ route('users.index') }}" class="text-primary hover:underline">Utilisateur</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <span>{{ __('Ajouter un utilisateur') }}</span>
    </li>
</ul>
<br>
<!-- Fin du titre de la page -->

@include('flash-message')

<div class="card">
    <div class="card-body">
        <form class="space-y-5" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="firstname">{{ __('Prénom') }}</label>
                        <input type="text" name="firstname" class="form-input @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" required>
                        @error('firstname')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="lastname">{{ __('Nom de famille') }}</label>
                        <input type="text" name="lastname" class="form-input @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" required>
                        @error('lastname')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="datenaiss">{{ __('Date de naissance') }}</label>
                        <input type="date" name="datenaiss" class="form-input @error('datenaiss') is-invalid @enderror" value="{{ old('datenaiss') }}" required>
                        @error('datenaiss')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="lieu_naissance">{{ __('Lieu de naissance') }}</label>
                        <input type="text" name="lieu_naissance" class="form-input @error('lieu_naissance') is-invalid @enderror" value="{{ old('lieu_naissance') }}" required>
                        @error('lieu_naissance')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="sexe">{{ __('Genre') }}</label>
                        <select name="sexe" class="form-input @error('sexe') is-invalid @enderror" required>
                            <option value="male" {{ old('sexe') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                            <option value="female" {{ old('sexe') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                        </select>
                        @error('sexe')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input type="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="telephone" class="block">{{ __('Téléphone') }}<span class="text-red-500">*</span></label>
                        <div id="phone-container" class="relative">
                            <input type="tel" name="telephone" id="telephone" class="form-input w-full @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}">
                            <div id="flag-container" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <!-- Ajouter votre élément de drapeau ici -->
                            </div>
                        </div>
                        @error('telephone')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="username">{{ __("Nom d'utilisateur") }}</label>
                        <input type="text" name="username" class="form-input @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                        @error('username')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="password">{{ __('Mot de passe') }}</label>
                        <input type="password" name="password" class="form-input @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
                        @error('password')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="avatar">{{ __('Avatar') }}</label>
                        <input type="file" name="avatar" class="form-input @error('avatar') is-invalid @enderror" value="{{ old('avatar') }}">
                        @error('avatar')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <strong>{{ __('Rôle') }}:</strong>
                        {!! Form::select('roles[]', $roles, old('roles'), ['class' => 'form-input', 'multiple']) !!}
                        @error('roles')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Ajouter') }}</button>
        </form>

    </div>
</div>

@endsection
