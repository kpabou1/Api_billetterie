@extends('layouts.app')

@section('title', __('Edit User'))

@section('content')

<!-- Début du titre de la page -->
<ul class="flex space-x-2 rtl:space-x-reverse">
    <li>
        <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <a href="{{ route('users.index') }}" class="text-primary hover:underline">Users</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <span>Edit User </span>
    </li>
</ul>
<br>
<!-- Fin du titre de la page -->

<div class="card">
    <div class="card-body">
        <form class="space-y-5" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="firstname">{{ __('First Name') }}</label>
                        <input type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}" class="form-input @error('firstname') is-invalid @enderror" required>
                        @error('firstname')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="lastname">{{ __('Last Name') }}</label>
                        <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}" class="form-input @error('lastname') is-invalid @enderror" required>
                        @error('lastname')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="datenaiss">{{ __('Date of Birth') }}</label>
                        <input type="date" name="datenaiss" value="{{ old('datenaiss', $user->datenaiss) }}" class="form-input @error('datenaiss') is-invalid @enderror" required>
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
                        <label for="lieu_naissance">{{ __('Place of Birth') }}</label>
                        <input type="text" name="lieu_naissance" value="{{ old('lieu_naissance', $user->lieu_naissance) }}" class="form-input @error('lieu_naissance') is-invalid @enderror" required>
                        @error('lieu_naissance')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="sexe">{{ __('Gender') }}</label>
                        <select name="sexe" class="form-input @error('sexe') is-invalid @enderror" required>
                            <option value="male" {{ old('sexe', $user->sexe) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('sexe', $user->sexe) == 'female' ? 'selected' : '' }}>Female</option>
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
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input @error('email') is-invalid @enderror">
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
                        <label for="telephone">{{ __('Telephone') }}</label>
                        <input type="tel" name="telephone" value="{{ old('telephone', $user->telephone) }}" class="form-input @error('telephone') is-invalid @enderror" required>
                        @error('telephone')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="username">{{ __('Username') }}</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-input @error('username') is-invalid @enderror" required>
                        @error('username')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input type="password" name="password" class="form-input @error('password') is-invalid @enderror">
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
                        <input type="file" name="avatar" class="form-input @error('avatar') is-invalid @enderror">
                        @error('avatar')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <strong>{{ __('Role') }}:</strong>
                        {!! Form::select('roles[]', $roles, old('roles', $user->roles->pluck('name')), ['class' => 'form-input', 'multiple']) !!}
                        @error('roles')
                        <div class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Update User') }}</button>
        </form>

    </div>
</div>

@endsection
