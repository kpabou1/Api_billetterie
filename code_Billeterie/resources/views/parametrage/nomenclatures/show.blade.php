@extends('layouts.app')

@section('title')
    {{__('Détails Nomenclature')}}
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('Détails Nomenclature')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboards</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('nomenclatures.index') }}">Nomenclatures liste</a></li>
                        <li class="breadcrumb-item active">Détails Nomenclature</li>
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
                <label for="annee" class="col-md-2 col-form-label">{{__('Année')}}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="annee" name="annee" value="{{ $nomenclature->annee }}" readonly>
                </div>

                <label for="chrono" class="col-md-2 col-form-label">{{__('Chrono')}}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="chrono" name="chrono" value="{{ $nomenclature->chrono }}" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="type_contribuable" class="col-md-2 col-form-label">{{__('Type Contribuable')}}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="type_contribuable" name="type_contribuable" value="{{ $nomenclature->type_contribuable }}" readonly>
                </div>

                <label for="cle" class="col-md-2 col-form-label">{{__('Clé')}}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="cle" name="cle" value="{{ $nomenclature->cle }}" readonly>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <a href="{{ route('nomenclatures.index') }}" class="btn btn-secondary">{{__('Retour')}}</a>
                </div>

                <div class="col-md-2"></div>
            </div>

        </div>
    </div>

@endsection
