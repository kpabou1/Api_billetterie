@extends('layouts.app')

@section('title', __('Modifier Activite Principale'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Modifier Activite Principale')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('activite_principales.index') }}">{{__('Activite Principales')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Modifier Activite Principale')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('activite_principales.update', ['id' => $activitePrincipale->id]) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="code">{{ __('Code') }}</label>
                    <input type="text" name="code" class="form-control" value="{{ $activitePrincipale->code }}" required>
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>

                <div class="form-group col-md-6">
                    <label for="libelle">{{ __('Activite Principale') }}</label>
                    <input type="text" name="libelle" class="form-control" value="{{ $activitePrincipale->libelle }}" required>
                    <x-input-error :messages="$errors->get('libelle')" class="mt-2" />
                </div>
            </div>

            <!-- Ajoutez d'autres champs nécessaires pour la modification de l'activité principale -->

            <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
        </form>
    </div>
</div>

@endsection
