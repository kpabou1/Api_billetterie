@extends('layouts.app')

@section('title', __('Edit Exercice'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Edit Exercice')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('exercices.index') }}">{{__('Exercices')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Edit Exercice')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('exercices.update', ['id' => $exercice->id]) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date_debut">{{ __('Date de début') }}</label>
                    <input type="date" name="date_debut" class="form-control" value="{{ $exercice->date_debut }}"
                        required>
                    <x-input-error :messages="$errors->get('date_debut')" class="mt-2" />
                </div>

                <div class="form-group col-md-6">
                    <label for="date_fin">{{ __('Date de fin') }}</label>
                    <input type="date" name="date_fin" class="form-control" value="{{ $exercice->date_fin }}" required>
                    <x-input-error :messages="$errors->get('date_fin')" class="mt-2" />
                </div>
                <div class="form-group col-md-6">
                    <label for="statut">{{ __('État de l\'exercice') }}</label>

                    <select name="statut" class="form-control @error('statut') is-invalid @enderror">
                        <option value="" disabled selected>{{ __("Sélectionnez une option") }}</option>
                        <option value="actif" @if($exercice->statut =='actif' ) selected @endif>Actif</option>
                        <option value="bloquer" @if($exercice->statut =='bloquer' ) selected @endif>Bloqué</option>
                    </select>

                    @error('statut')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Ajoutez d'autres champs nécessaires pour la modification de l'exercice -->

            <button type="submit" class="btn btn-primary">{{ __('Update Exercice') }}</button>
        </form>
    </div>
</div>

@endsection