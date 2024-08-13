@extends('layouts.app')

@section('title', __('Ajouter une annonce'))

@section('content')

<!-- Start page title -->
<ul class="flex space-x-2 rtl:space-x-reverse">
    <li>
        <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <a href="{{ route('annonces.index') }}" class="text-primary hover:underline">Annonces</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <span>{{ __('Ajouter une annonce') }}</span>
    </li>
</ul>
<br>
<!-- End page title -->

@include('flash-message')

<div class="card">
    <div class="card-body">
        <form class="space-y-5" action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="titre">{{ __('Titre') }}</label>
                        <input type="text" name="titre" class="form-input @error('titre') is-invalid @enderror" required>
                        @error('titre')
                        <x-input-error :message="$message" />
                        @enderror
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="categorie">{{ __('Catégorie') }}</label>
                        <input type="text" name="categorie" class="form-input @error('categorie') is-invalid @enderror">
                        @error('categorie')
                        <x-input-error :message="$message" />
                        @enderror
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="type_service">{{ __('Type de Service') }}</label>
                        <input type="text" name="type_service" class="form-input @error('type_service') is-invalid @enderror">
                        @error('type_service')
                        <x-input-error :message="$message" />
                        @enderror
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="type_activite">{{ __('Type d\'Activité') }}</label>
                        <input type="text" name="type_activite" class="form-input @error('type_activite') is-invalid @enderror">
                        @error('type_activite')
                        <x-input-error :message="$message" />
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" class="form-input @error('description') is-invalid @enderror"></textarea>
                        @error('description')
                        <x-input-error :message="$message" />
                        @enderror
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="prix">{{ __('Prix') }}</label>
                        <input type="text" name="prix" class="form-input @error('prix') is-invalid @enderror">
                        @error('prix')
                        <x-input-error :message="$message" />
                        @enderror
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <div class="form-group">
                        <label for="localisation">{{ __('Localisation') }}</label>
                        <input type="text" name="localisation" class="form-input @error('localisation') is-invalid @enderror">
                        @error('localisation')
                        <x-input-error :message="$message" />
                        @enderror
                    </div>
                </div>
                <div class="w-full px-3">
                    <div class="form-group">
                        <label for="ficher_annonce">{{ __('Fichier Annonce') }}</label>
                        <input type="file" name="ficher_annonce" class="form-input @error('ficher_annonce') is-invalid @enderror" required>
                        @error('ficher_annonce')
                        <x-input-error :message="$message" />
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Ajouter') }}</button>
        </form>
    </div>
</div>

@endsection
