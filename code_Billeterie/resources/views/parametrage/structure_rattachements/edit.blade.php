@extends('layouts.app')

@section('title', __('Modifier la Structure de Rattachement'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Modifier la Structure de Rattachement')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('structure_rattachements.index') }}">{{__('Structure Rattachements')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Modifier la Structure de Rattachement')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
    <form action="{{ route('structure_rattachements.update', ['id' => $structureRattachement->id]) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="code">{{ __('Code') }}</label>
                    <input type="text" name="code" class="form-control" value="{{ $structureRattachement->code }}" required>
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>

                <div class="form-group col-md-6">
                    <label for="libelle">{{ __('Structure de Rattachement') }}</label>
                    <input type="text" name="libelle" class="form-control" value="{{ $structureRattachement->libelle }}" required>
                    <x-input-error :messages="$errors->get('libelle')" class="mt-2" />
                </div>
            </div>

            <!-- Ajoutez d'autres champs nécessaires pour la modification de la structure de rattachement -->

            <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
        </form>
    </div>
</div>

@endsection
