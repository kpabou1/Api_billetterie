@extends('layouts.app')

@section('title')
    {{__('Détails Structure Rattachement')}}
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('Détails Structure Rattachement')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboards</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('structure_rattachements.index') }}">Structure Rattachements liste</a></li>
                        <li class="breadcrumb-item active">Détails Structure Rattachement</li>
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
                <label for="code" class="col-md-2 col-form-label">{{__('Code')}}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="code" name="code" value="{{ $structureRattachement->code }}" readonly>
                </div>

                <label for="libelle" class="col-md-2 col-form-label">{{__('Structure de Rattachement')}}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="libelle" name="libelle" value="{{ $structureRattachement->libelle }}" readonly>
                </div>
            </div>

            <!-- Ajoutez d'autres champs nécessaires pour l'affichage de la structure de rattachement -->

            <div class="form-group row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <a href="{{ route('structure_rattachements.index') }}" class="btn btn-secondary">{{__('Retour')}}</a>
                </div>

                <div class="col-md-2"></div>
                <div class="col-md-4">
                <a href="{{ route('structure_rattachements.edit', ['id' => $structureRattachement->id]) }}" class="btn btn-primary">{{__('Modifier')}}</a>
                </div>
            </div>

        </div>
    </div>

@endsection
