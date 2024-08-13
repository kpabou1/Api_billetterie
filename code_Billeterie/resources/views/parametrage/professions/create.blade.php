@extends('layouts.app')

@section('title')
    {{__('Créer la Profession')}}
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('Créer la Profession')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboards</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('professions.index') }}">listes des Professions </a></li>
                        <li class="breadcrumb-item active">Créer la Profession</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    @include('flash-message')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('professions.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="code">{{__('Code')}}</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>

                    <div class="col-md-6">
                        <label for="libelle">{{__('Profession')}}</label>
                        <input type="text" class="form-control" id="libelle" name="libelle" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">{{__('CRÉER')}}</button>
            </form>
        </div>
    </div>

@endsection
