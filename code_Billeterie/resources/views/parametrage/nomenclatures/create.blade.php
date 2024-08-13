@extends('layouts.app')

@section('title')
    {{__('Créer une Nomenclature')}}
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('Créer une Nomenclature')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboards</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('nomenclatures.index') }}">listes des Nomenclatures </a></li>
                        <li class="breadcrumb-item active">Créer une Nomenclature</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    @include('flash-message')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('nomenclatures.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="annee">{{__('Année')}}</label>
                        @if(request()->is('nomenclatures/create'))
                            <input type="text" class="form-control" id="annee" name="annee" value="{{ date('Y') }}" required>
                        @else
                            <input type="text" class="form-control" id="annee" name="annee" value="{{ old('annee') }}" required>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="chrono">{{__('Chrono')}}</label>
                        <input type="text" class="form-control" id="chrono" name="chrono" value="{{ rand(10000, 99999) }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="type_contribuable">{{__('Type Contribuable')}}</label>
                        <select class="form-control" id="type_contribuable" name="type_contribuable" required>
                            <option value="PA">Particulier</option>
                            <option value="PR">Professionnel</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="cle">{{__('Clé')}}</label>
                        <input type="text" class="form-control" id="cle" name="cle" value="{{ rand(1, 9) }}" readonly>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">{{__('CRÉER')}}</button>
            </form>
        </div>
    </div>

@endsection
