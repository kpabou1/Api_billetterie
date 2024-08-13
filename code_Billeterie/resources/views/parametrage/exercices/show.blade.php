@extends('layouts.app')

@section('title', __('Show Exercice'))

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('Show Exercice')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('exercices.index') }}">{{__('Exercices')}}</a></li>
                        <li class="breadcrumb-item active">{{__('Show Exercice')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    @include('flash-message')

    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label for="date_debut" class="col-md-2 col-form-label">{{__('Date de début')}}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="date_debut" name="date_debut" value="{{ $exercice->date_debut }}" readonly>
                </div>

                <label for="date_fin" class="col-md-2 col-form-label">{{__('Date de fin')}}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="date_fin" name="date_fin" value="{{ $exercice->date_fin }}" readonly>
                </div>
            </div>

            <!-- Ajoutez d'autres champs nécessaires pour l'affichage de l'exercice -->

            <div class="form-group row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <a href="{{ route('exercices.index') }}" class="btn btn-secondary">{{__('Retour')}}</a>
                </div>

                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <a href="{{ route('exercices.edit', ['id' => $exercice->id]) }}" class="btn btn-primary">{{__('Modifier')}}</a>
                </div>
            </div>

        </div>
    </div>

@endsection
