@extends('layouts.app')

@section('title', __('Suivi des Années'))

@section('content')
    <!-- Début du titre de la page -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-primary">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Liste des années') }}</li>
        </ol>
    </nav>
    <!-- Fin du titre de la page -->

    @include('flash-message')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="card-header"></div>
        <div class="d-flex align-items-center">
            <button class="btn btn-info btn-sm" id="filterBtn">
                <i class="fa fa-filter"></i> {{ __('Filtrer par date') }}
            </button>
            <a href="{{ route('annees.create') }}" class="btn btn-primary btn-sm ml-2">
                <i class="fa fa-plus"></i> {{ __('Ajouter année') }}
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover w-100" id="anneesTable">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Libellé') }}</th>
                    <th scope="col">{{ __('Description') }}</th>
                    <th scope="col">{{ __('Statut') }}</th>
                    <th scope="col">{{ __('Date de début') }}</th>
                    <th scope="col">{{ __('Date de fin') }}</th>
                    <th scope="col">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Modal de filtre -->
    <div id="filterModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">{{ __('Filtrer par date') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="from_date" class="col-form-label">{{ __('Date de début') }}</label>
                        <input type="date" class="form-control" id="from_date">
                    </div>
                    <div class="form-group">
                        <label for="to_date" class="col-form-label">{{ __('Date de fin') }}</label>
                        <input type="date" class="form-control" id="to_date">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Fermer') }}</button>
                    <button type="button" class="btn btn-primary" id="applyFilter">{{ __('Filtrer') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#anneesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('annees.index') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'libelle', name: 'libelle' },
                    { data: 'description', name: 'description' },
                    { data: 'statut', name: 'statut' },
                    { data: 'date_debut', name: 'date_debut' },
                    { data: 'date_fin', name: 'date_fin' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '10%'
                    }
                ],
                order: [[2, 'desc']],
               
            });

            $('#filterBtn').on('click', function() {
                $('#filterModal').modal('show');
            });

            $('#applyFilter').on('click', function() {
                table.ajax.reload();
                $('#filterModal').modal('hide');
            });

            $('#anneesTable').on('click', '.delete-btn', function(event) {
                event.preventDefault();

                var form = $(this).closest('form');

                Swal.fire({
                    title: '{{ __("Confirmation") }}',
                    text: '{{ __("Êtes-vous sûr de vouloir supprimer cette année ?") }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __("Oui, supprimer!") }}',
                    cancelButtonText: '{{ __("Annuler") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
