@extends('layouts.app')

@section('title', __('Créer le Domicile Fiscal'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Créer le Domicile Fiscal')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('domicile_fiscals.index') }}">{{__('Domicile Fiscals')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Créer le Domicile Fiscal')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('domicile_fiscals.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="code">{{ __('Code') }}</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" required>
                    @error('code')
                    <x-input-error :message="$message" />
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="libelle">{{ __('Domicile Fiscal') }}</label>
                    <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror" required>
                    @error('libelle')
                    <x-input-error :message="$message" />
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('CRÉER') }}</button>
        </form>
    </div>
</div>

@endsection
