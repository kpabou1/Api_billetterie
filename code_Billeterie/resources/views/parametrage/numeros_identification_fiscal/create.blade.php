@extends('layouts.app')

@section('title', __('Create Numero Identification Fiscal'))

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{__('Create Numero Identification Fiscal')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('numeros_identification_fiscal.index') }}">{{__('Numero Identification Fiscals')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Create Numero Identification Fiscal')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('numeros_identification_fiscal.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="status">{{ __('Status') }}</label>
                <select name="status" class="form-control">
                    <option value="Actif">{{ __('Actif') }}</option>
                    <option value="Inactif">{{ __('Inactif') }}</option>
                </select>

                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <div class="form-group">
                <label for="id_nomenclature">{{ __('Nomenclature') }}</label>
                <select name="id_nomenclature" class="form-control" id="nomenclatureSelect">
                    @foreach($nomenclaturesNonAttribuees as $nomenclature)
                        <option value="{{ $nomenclature->id }}" data-type="{{ $nomenclature->type_contribuable }}">
                            {{ $nomenclature->type_contribuable }} ({{ $nomenclature->annee }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>{{ __('Sélectionnez le type') }}</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" value="particulier" checked>
                    <label class="form-check-label">
                        {{ __('Particulier') }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" value="professionnel">
                    <label class="form-check-label">
                        {{ __('Professionnel') }}
                    </label>
                </div>
            </div>


            <!-- Ajoutez d'autres champs nécessaires pour la création de Numero Identification Fiscal -->

            <button type="submit" class="btn btn-primary">{{ __('Create Numero Identification Fiscal') }}</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Gérez le changement de la nomenclature
        $('#nomenclatureSelect').on('change', function() {
            var selectedType = $(this).find('option:selected').data('type');
            if (selectedType === 'PP') {
                $('input[name="type"][value="particulier"]').prop('checked', true);
            } else if (selectedType === 'PM') {
                $('input[name="type"][value="professionnel"]').prop('checked', true);
            }
        });

        $('input[type="radio"]').on('change', function () {
            if ($(this).val() === 'particulier') {
                $('.particulier-fields').show();
                $('.professionnel-fields').hide();
            } else {
                $('.particulier-fields').hide();
                $('.professionnel-fields').show();
            }
        });

        // Assurez-vous que l'état initial correspond au choix par défaut
        if ($('input[type="radio"]:checked').val() === 'particulier') {
            $('.particulier-fields').show();
            $('.professionnel-fields').hide();
        } else {
            $('.particulier-fields').hide();
            $('.professionnel-fields').show();
        }
    });
</script>

@endsection
