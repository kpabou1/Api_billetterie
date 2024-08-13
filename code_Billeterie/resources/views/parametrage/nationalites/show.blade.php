@extends('layouts.app')

@section('title', __('Details de la Nationalité'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Details de la Nationalité')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('nationalites.index') }}">{{__('Nationalities')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Details de la Nationalité')}}</li>
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
                    <input type="text" class="form-control" id="id" name="id" value="{{ $nationalite->id }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="libelle" class="col-md-2 col-form-label"><strong>Nationalité:</strong></label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="libelle" name="libelle" value="{{ $nationalite->libelle }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="code" class="col-md-2 col-form-label"><strong>Code:</strong></label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="code" name="code" value="{{ $nationalite->code }}" readonly>
                </div>
            </div>
            <!-- Vous pouvez ajouter d'autres champs ici au besoin -->

            <div class="form-group row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <a href="{{ route('nationalites.index') }}" class="btn btn-primary">{{ __('Retour') }}</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('nationalites.edit', ['id' => $nationalite->id]) }}" class="btn btn-info">{{ __('Modifier') }}</a>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</div>

@endsection
