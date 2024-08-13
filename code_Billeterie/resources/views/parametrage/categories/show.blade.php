@extends('layouts.app')

@section('title')
    Détails de la catégorie
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Détails de la catégorie</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboards</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Catégories liste</a></li>
                        <li class="breadcrumb-item active">Détails de la catégorie</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    @include('flash-message')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="id" class="col-md-2 col-form-label"><strong>ID:</strong></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="id" name="id" value="{{ $categorie->id }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="libelle" class="col-md-2 col-form-label"><strong>Catégorie:</strong></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="libelle" name="libelle" value="{{ $categorie->libelle }}" readonly>
                    </div>
                </div>
                <!-- Vous pouvez ajouter d'autres champs ici au besoin -->

                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Retour à la liste</a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ route('categories.edit', ['id' => $categorie->id]) }}" class="btn btn-info">Modifier</a>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
