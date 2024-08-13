@extends('layouts.app')

@section('title', __('Create Exercice'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Create Exercice')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('exercices.index') }}">{{__('Exercices')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Create Exercice')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('exercices.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date_debut">{{ __('Date de début') }}</label>
                    <input type="date" name="date_debut" value="{{ old('date_debut') }}" class="form-control @error('date_debut') is-invalid @enderror" required>

                    @error('date_debut')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="date_fin">{{ __('Date de fin') }}</label>
                    <input type="date" name="date_fin" value="{{ old('date_fin') }}" class="form-control @error('date_fin') is-invalid @enderror" required>

                    @error('date_fin')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- statut actif ou bloquer par defaut bloquer -->
            <div class="form-group">
                <label for="statut">{{ __('Statut') }}</label>
                <select name="statut" class="form-control @error('statut') is-invalid @enderror" required>
                    <option value="bloquer" @if(old('statut')=="bloquer") selected @endif>{{ __('Bloquer') }}</option>
                    <option value="actif" @if(old('statut')=="actif") selected @endif>{{ __('Actif') }}</option>
                </select>

                @error('statut')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Create Exercice') }}</button>
        </form>
    </div>
</div>

@endsection
