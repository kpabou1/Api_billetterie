@extends('layouts.app')

@section('title', __('Modifier la Nationalité'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Modifier la Nationalité')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('nationalites.index') }}">{{__('Nationalities')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Modifier la Nationalité')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('nationalites.update', ['id' => $nationalite->id]) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="code">{{ __('Code') }}</label>
                    <input type="text" name="code" class="form-control" value="{{ $nationalite->code }}" required>
                    @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="code_numero">{{ __('Code Numero') }}</label>
                    <input type="text" name="code_numero" class="form-control" value="{{ $nationalite->code_numero }}" required>
                    @error('code_numero')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="libelle">{{ __('Nationalité') }}</label>
                    <input type="text" name="libelle" class="form-control" value="{{ $nationalite->libelle }}" required>
                    @error('libelle')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Ajoutez d'autres champs nécessaires pour la modification de la nationalité -->

            <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
        </form>
    </div>
</div>

@endsection
