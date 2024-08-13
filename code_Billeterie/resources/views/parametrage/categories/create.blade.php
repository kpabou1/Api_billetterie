@extends('layouts.app')

@section('title')
    Création d'une catégorie
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Création d'une catégorie</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboards</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Liste des Catégories</a></li>
                        <li class="breadcrumb-item active">Création d'une catégorie</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('categories.store') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="libelle">Catégorie</label>
                        <input type="text" class="form-control" name="libelle" id="libelle" value="{{ old('libelle') }}" required>
                    </div>
                    <!-- Vous pouvez ajouter d'autres champs au besoin ici -->
                </div>

                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </div>
    </div>
@endsection
