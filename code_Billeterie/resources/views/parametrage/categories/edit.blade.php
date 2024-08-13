@extends('layouts.app')

@section('title', __('Modifier la Categorie'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Modifier la Categorie')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">{{__('Categories')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Modifier la Categorie')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('categories.update', ['id' => $categorie->id]) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="libelle">{{ __('Catégorie') }}</label>
                    <input type="text" name="libelle" class="form-control" value="{{ $categorie->libelle }}" required>
                    <x-input-error :messages="$errors->get('libelle')" class="mt-2" />
                </div>

                <!-- Add other fields necessary for Modifier laing the category -->

            </div>

            <button type="submit" class="btn btn-primary">{{ __('Modifier la Categorie') }}</button>
        </form>
    </div>
</div>

@endsection
