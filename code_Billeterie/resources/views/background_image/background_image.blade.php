@extends('layouts.app')

@section('title', __('Modification Image'))

@section('content')

    <!-- Start page title -->
    <ul class="flex space-x-2 rtl:space-x-reverse text-gray-600">
        <li>
            <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1 text-gray-600">
            <a href="{{ route('ppm.index') }}" class="text-primary hover:underline">Fond Images</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1 text-gray-600">
            <span>{{ __('Modification image') }}</span>
        </li>
    </ul>
    <br>
    <!-- End page title -->

    @include('flash-message')

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="card-body space-y-6">
            @if($backgroundImage && $backgroundImage->image_path_welcome)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Image actuelle du fond :</h3>
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $backgroundImage->image_path_welcome) }}" alt="Image actuelle" class="rounded-lg shadow-lg w-full max-w-xl h-64 object-cover">
                    </div>
                </div>
            @endif

            @if($backgroundImage && $backgroundImage->image_path_login)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Image actuelle de l'utilisateur :</h3>
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $backgroundImage->image_path_login) }}" alt="Image actuelle de l'utilisateur" class="rounded-lg shadow-lg w-full max-w-xl h-64 object-cover">
                    </div>
                </div>
            @endif

            <form action="{{ route('background_image.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="background_image" class="block text-sm font-medium text-gray-700">Sélectionner une nouvelle image de fond :</label>
                    <input type="file" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" id="background_image" name="background_image" >
                </div>

                <div>
                    <label for="user_image" class="block text-sm font-medium text-gray-700">Sélectionner une nouvelle image de l'utilisateur :</label>
                    <input type="file" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" id="user_image" name="user_image">
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-md shadow-sm hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Charger
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
