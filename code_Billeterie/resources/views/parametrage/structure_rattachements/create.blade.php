@extends('layouts.app')

@section('title', __('Créer une Structure de Rattachement'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Créer une Structure de Rattachement')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('structure_rattachements.index') }}">{{__('Structure Rattachements')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Créer une Structure de Rattachement')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('structure_rattachements.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="code">{{ __('Code') }}</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" required>
                    @error('code')
                    <x-input-error :message="$message" />
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="libelle">{{ __('Structure de Rattachement') }}</label>
                    <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror" required>
                    @error('libelle')
                    <x-input-error :message="$message" />
                    @enderror
                </div>
            </div>

            <!-- Ajoutez d'autres champs nécessaires pour la création de la structure rattachement -->

            <button type="submit" class="btn btn-primary">{{ __('CRÉER') }}</button>
        </form>
    </div>
</div>

@endsection
