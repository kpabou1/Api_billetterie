@extends('layouts.app')

@section('title', __('Edit Numero Identification Fiscal'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Edit Numero Identification Fiscal')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('numeroidentification.index') }}">{{__('Numero Identification Fiscals')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Edit Numero Identification Fiscal')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('numeroidentification.update', ['id' => $numeroidentification->id]) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="libelle">{{ __('Libelle') }}</label>
                <input type="text" name="libelle" class="form-control" value="{{ $numeroidentification->libelle }}" required>
                <x-input-error :messages="$errors->get('libelle')" class="mt-2" />
            </div>

            <div class="form-group">
                <label for="status">{{ __('Status') }}</label>
                <input type="text" name="status" class="form-control" value="{{ $numeroidentification->status }}" required>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <div class="form-group">
                <label for="id_nomenclature">{{ __('Nomenclature') }}</label>
                <select name="id_nomenclature" class="form-control">
                    @foreach($nomenclatures as $nomenclature)
                        <option value="{{ $nomenclature->id }}" {{ $numeroidentification->id_nomenclature == $nomenclature->id ? 'selected' : '' }}>
                            {{ $nomenclature->libelle }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_particulier">{{ __('Particulier') }}</label>
                <select name="id_particulier" class="form-control">
                    @foreach($particuliers as $particulier)
                        <option value="{{ $particulier->id }}" {{ $numeroidentification->id_particulier == $particulier->id ? 'selected' : '' }}>
                            {{ $particulier->libelle }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Ajoutez d'autres champs nécessaires pour la modification de Numero Identification Fiscal -->

            <button type="submit" class="btn btn-primary">{{ __('Update Numero Identification Fiscal') }}</button>
        </form>
    </div>
</div>
@endsection
