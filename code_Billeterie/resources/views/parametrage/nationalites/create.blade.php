@extends('layouts.app')

@section('title', __('Créer la Nationalité'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Créer la Nationalité')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('nationalites.index') }}">{{__('Nationalities')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{__('Créer la Nationalité')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>




<div class="card">
    <div class="card-body">
        <form action="{{ route('nationalites.store') }}" method="POST">
            @csrf

       

        
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="code_numero">{{ __('Numéros') }}</label>
                    <input type="number" name="code_numero"
                        class="form-control @error('code_numero') is-invalid @enderror" required>

                    @error('code_numero')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="code">{{ __('Code Pays') }}</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" required>

                    @error('code')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="libelle">{{ __('Nationalité') }}</label>
                    <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror"
                        required>

                    @error('libelle')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('CRÉER') }}</button>
        </form>
    </div>
</div>

@endsection