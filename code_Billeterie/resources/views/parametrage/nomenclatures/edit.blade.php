@extends('layouts.app')

@section('title')
    {{__('Modifier la Nomenclature')}}
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('Modifier la Nomenclature')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboards</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('nomenclatures.index') }}">Nomenclatures liste</a></li>
                        <li class="breadcrumb-item active">Modifier la Nomenclature</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    @include('flash-message')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('nomenclatures.update', ['id' => $nomenclature->id]) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="annee">{{__('Année')}}</label>
                        <input type="text" class="form-control" id="annee" name="annee" value="{{ old('annee', $nomenclature->annee) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="chrono">{{__('Chrono')}}</label>
                        <input type="text" class="form-control" id="chrono" name="chrono" value="{{ $nomenclature->chrono }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="type_contribuable">{{__('Type Contribuable')}}</label>
                        <select class="form-control" id="type_contribuable" name="type_contribuable" required>
                            <option value="PP" {{ old('type_contribuable', $nomenclature->type_contribuable) === 'PP' ? 'selected' : '' }}>Personne Physique</option>
                            <option value="PM" {{ old('type_contribuable', $nomenclature->type_contribuable) === 'PM' ? 'selected' : '' }}>Personne Morale</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="cle">{{__('Clé')}}</label>
                        <input type="text" class="form-control" id="cle" name="cle" value="{{ $nomenclature->cle }}" readonly>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">{{__('Modifier')}}</button>
            </form>
        </div>
    </div>

@endsection
