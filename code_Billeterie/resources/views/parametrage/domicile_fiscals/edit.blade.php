@extends('layouts.app')

@section('title', __('Modifier le Domicile Fiscal'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Modifier le Domicile Fiscal')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('domicile_fiscals.index') }}">{{__('Domicile Fiscals')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Modifier le Domicile Fiscal')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('domicile_fiscals.update', ['id' => $DomicilFiscal->id]) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="code">{{ __('Code') }}</label>
                    <input type="text" name="code" class="form-control" value="{{ $DomicilFiscal->code }}" required>
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>

                <div class="form-group col-md-4">
                    <label for="libelle">{{ __('Domicile Fiscal') }}</label>
                    <input type="text" name="libelle" class="form-control" value="{{ $DomicilFiscal->libelle }}" required>
                    <x-input-error :messages="$errors->get('libelle')" class="mt-2" />
                </div>
            </div>

            <!-- Ajoutez d'autres champs nécessaires pour la modification du domicile fiscal -->

            <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
        </form>
    </div>
</div>

@endsection
