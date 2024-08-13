@extends('layouts.app')

@section('Profile')
{{__('Dashboard')}}
@endsection

@section('content')
<style>
    .tab-pane {
        display: none;
    }
    .tab-pane.active {
        display: block;
    }
</style>

<div class="container mx-auto mt-8">
    <div class="relative -mx-4 -mt-4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ asset('assets/assets/images/0.jpg') }}" class="w-1/2 h-auto rounded-lg mx-auto" alt="">
            <div class="absolute inset-0 bg-black bg-opacity-50">
                <div class="flex justify-end p-3">
                    <div class="rounded-full overflow-hidden">
                        <input id="profile-foreground-img-file-input" type="file" class="hidden">
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <form id="profileUpdateForm" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="mt-8">
        @csrf
        @method('patch')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="col-span-1">
                <div class="bg-white shadow-md rounded-lg p-4">
                    <div class="text-center">
                        <div class="relative inline-block mb-4">
                            @if(Auth::user()->avatar)
                            <img class="rounded-full w-32 h-32 object-cover" src="{{ asset('storage/' . Auth::user()->avatar ?? 'assets/assets/images/users/user-default.jpg') }}" alt="avatar">
                            @else
                            <img class="rounded-full w-32 h-32 object-cover" src="{{ asset('assets/assets/images/users/user-default.jpg') }}" alt="avatar">
                            @endif
                            <div class="absolute bottom-0 right-0">
                                <input id="profile-img-file-input" type="file" name="profile_picture" class="hidden" accept="image/*">
                                <label for="profile-img-file-input" class="bg-light text-body p-2 rounded-full cursor-pointer">
                                    <i class="ri-camera-fill"></i>
                                </label>
                            </div>
                        </div>
                        <h5 class="text-xl font-semibold mb-1">{{$user["lastname"]}} {{$user["firstname"]}}</h5>
                        <p class="text-gray-500">{{auth()->user()->roles->first()->name}}</p>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-lg p-4 mt-4">
                    <div class="flex items-center mb-4">
                        <h5 class="text-lg font-semibold">Complète ton profil</h5>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-red-600 h-2.5 rounded-full" style="width: 95%"></div>
                    </div>
                </div>

                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="col-span-2">
                <div class="bg-white shadow-md rounded-lg p-4">
                    <ul class="flex border-b mb-4">
                        <li class="mr-1">
                            <a class="inline-block py-2 px-4 text-blue-700 hover:bg-gray-100 rounded-t-lg tab-link active" data-tab="personalDetails">Détails personnels</a>
                        </li>
                        <li class="mr-1">
                            <a class="inline-block py-2 px-4 text-blue-700 hover:bg-gray-100 rounded-t-lg tab-link" data-tab="changePassword">Changer le mot de passe</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="firstnameInput" class="block text-gray-700">Prénom</label>
                                    <input type="text" id="firstnameInput" name="firstname" value="{{$user['firstname']}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label for="lastnameInput" class="block text-gray-700">Nom de famille</label>
                                    <input type="text" id="lastnameInput" name="lastname" value="{{$user['lastname']}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="phonenumberInput" class="block text-gray-700">Numéro de téléphone</label>
                                <input type="tel" id="phone_number" name="phone_number" placeholder="Enter your phone number" value="{{$user['telephone']}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div class="mt-4">
                                <label for="emailInput" class="block text-gray-700">Email Address</label>
                                <input type="email" id="emailInput" name="email" value="{{$user['email']}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div class="mt-4 flex justify-between">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update</button>
                                <a href="{{ route('dashboard') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg">Cancel</a>
                            </div>
                        </div>

                        <div class="tab-pane" id="changePassword">
                            <form method="post" id="changePasswordForm" action="{{ route('password.update') }}">
                                @csrf
                                @method('PATCH')
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="relative">
                                        <label for="oldpasswordInput" class="block text-gray-700">Ancien mot de passe*</label>
                                        <input type="password" id="oldpasswordInput" name="current_password" placeholder="Entrer le mot de passe actuel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm pr-10">
                                        <i class="fas fa-eye-slash absolute right-3 top-10 cursor-pointer text-gray-500" onclick="togglePassword('oldpasswordInput', this)"></i>
                                        @error('current_password')
                                        <div class="text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="relative">
                                        <label for="newpasswordInput" class="block text-gray-700">Nouveau mot de passe*</label>
                                        <input type="password" id="newpasswordInput" name="password" placeholder="Entrer un nouveau mot de passe" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm pr-10">
                                        <i class="fas fa-eye-slash absolute right-3 top-10 cursor-pointer text-gray-500" onclick="togglePassword('newpasswordInput', this)"></i>
                                        @error('password')
                                        <div class="text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="relative">
                                        <label for="confirmpasswordInput" class="block text-gray-700">Confirmez le mot de passe*</label>
                                        <input type="password" id="confirmpasswordInput" name="password_confirmation" placeholder="Confirmez le mot de passe" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm pr-10">
                                        <i class="fas fa-eye-slash absolute right-3 top-10 cursor-pointer text-gray-500" onclick="togglePassword('confirmpasswordInput', this)"></i>
                                        @error('password_confirmation')
                                        <div class="text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-between">
                                    <button id="changePasswordBtn" type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Changer le mot de passe</button>
                                    <a href="{{ route('dashboard') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg">Annuler</a>
                                </div>
                            </form>
                        </div>
                        <script>
                            function togglePassword(inputId, icon) {
                                const input = document.getElementById(inputId);
                                const isPassword = input.type === 'password';
                                input.type = isPassword ? 'text' : 'password';
                        
                                // Changer l'icône
                                icon.classList.toggle('fa-eye-slash', !isPassword);
                                icon.classList.toggle('fa-eye', isPassword);
                            }
                        </script>
                                                
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tabLinks = document.querySelectorAll('.tab-link');

        tabLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                tabLinks.forEach(function(link) {
                    link.classList.remove('active');
                });
                this.classList.add('active');

                var targetId = this.getAttribute('data-tab');
                var tabContents = document.querySelectorAll('.tab-pane');
                tabContents.forEach(function(content) {
                    content.classList.remove('active');
                });
                var targetContent = document.getElementById(targetId);
                targetContent.classList.add('active');
            });
        });
    });
</script>
@endsection