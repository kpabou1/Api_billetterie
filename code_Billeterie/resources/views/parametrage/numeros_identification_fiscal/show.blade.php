@extends('layouts.app')

@section('title', __('Numéro d\'Identification Fiscal'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('Numéro d\'Identification Fiscal') }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Tableau de bord')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('numeros_identification_fiscal.index') }}">{{__('Numéros d\'Identification Fiscale')}}</a></li>
                    <li class="breadcrumb-item active">{{ __('Détails') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label for="id" class="col-md-2 col-form-label"><strong>ID:</strong></label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="id" name="id" value="{{ $numero_identification_fiscal->id }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nif" class="col-md-2 col-form-label"><strong>NIF:</strong></label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="nif" name="nif" value="{{ $numero_identification_fiscal->nif }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-md-2 col-form-label"><strong>Statut NIF:</strong></label>
                <div class="col-md-6" style="margin-left: -220px; margin-right: 520px;">
                    <input type="text" class="form-control" id="status" name="status" value="{{ $numero_identification_fiscal->status }}" readonly style="width:50%;"> <!-- Définition de la largeur à 100% -->
                </div>
            </div>

            <div class="form-group row">
                <label for="type_contribuable" class="col-md-2 col-form-label"><strong>Type Nomenclature:</strong></label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="type_contribuable" name="type_contribuable" value="{{ $numero_identification_fiscal->nomenclature->type_contribuable }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nom_contribuable" class="col-md-2 col-form-label"><strong>Nom Contribuable:</strong></label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="nom_contribuable" name="nom_contribuable" value="{{ $numero_identification_fiscal->particulier->user->lastname ?? '' }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="prenom_contribuable" class="col-md-2 col-form-label"><strong>Prénom Contribuable:</strong></label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="prenom_contribuable" name="prenom_contribuable" value="{{ $numero_identification_fiscal->particulier->user->firstname ?? '' }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="created_at" class="col-md-2 col-form-label"><strong>Date de création:</strong></label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $numero_identification_fiscal->created_at }}" readonly>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <a href="{{ route('numeros_identification_fiscal.index') }}" class="btn btn-primary">{{ __('Retour à la liste') }}</a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
