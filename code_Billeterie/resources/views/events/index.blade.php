@extends('layouts.app')

@section('title')
    {{ __('Annonces') }}
@endsection

@section('content')
    <!-- Début du titre de la page -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-primary">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Liste des Événements ') }}</li>
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
            <a href="{{ route('events_billets.create') }}" class="btn btn-primary btn-sm ml-2">
                <i class="fa fa-plus"></i> {{ __('Ajouter un événement ') }}
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover w-100" id="annoncesTable">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Titre de l\'événement') }}</th>
                    <th scope="col">{{ __('Date') }}</th>
                    <th scope="col">{{ __('Image') }}</th>
                    <th scope="col">{{ __('Lieu') }}</th>
                    <th scope="col">{{ __('Addrese') }}</th>
                    <th scope="col">{{ __('Statut de l\'événement') }}</th>
                    <th scope="col">{{ __('Date de création') }}</th>
                    <th scope="col">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Modal de filtre -->
    <div id="filterModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
        aria-hidden="true">
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
                        <label for="startDate" class="col-form-label">{{ __('Date de début') }}</label>
                        <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate" class="col-form-label">{{ __('Date de fin') }}</label>
                        <input type="date" class="form-control" id="endDate">
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
        var table;

        $(document).ready(function() {
            // Afficher le modal de filtre lors du clic sur le bouton de filtre
            $('#filterBtn').on('click', function() {
                $('#filterModal').modal('show');
            });

            // Appliquer le filtre et recharger les données du tableau
            $('#applyFilter').on('click', function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                table.ajax.url("{{ route('events_billets.index') }}?from_date=" + startDate + "&to_date=" +
                    endDate).load();
                $('#filterModal').modal('hide');
            });

            // Initialiser DataTable
            table = $('#annoncesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('events_billets.index') }}",
                columns: [{
                        data: 'event_id',
                        name: 'event_id'
                    },
                    {
                        data: 'event_title',
                        name: 'event_title'
                    },

                    {
                        data: 'event_date',
                        name: 'event_date'
                    },
                    {
                        data: 'event_image',
                        name: 'event_image',
                        render: function(data, type, row) {
                            var imageUrl = "{{ asset('storage/') }}/" + data;
                            return `<img src="${imageUrl}" alt="Image de l'événement" style="width: 100px; height: auto;">`;
                        }
                    },
                    {
                        data: 'event_city',
                        name: 'event_city'
                    },
                    {
                        data: 'event_address',
                        name: 'event_address'
                    },
                    {
                        data: 'event_status',
                        name: 'event_status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                               <div class="d-flex gap-2">
                                   <a href="{{ route('events_billets.edit', ['id' => '__id__']) }}" class="btn btn-sm btn-outline-info">
                                       <i class="fa fa-edit"></i>
                                   </a>
                                   <a href="{{ route('events_billets.show', ['id' => '__id__']) }}" class="btn btn-sm btn-outline-primary">
                                       <i class="fa fa-eye"></i>
                                   </a>
                                   <form action="{{ route('events_billets.destroy', ['id' => '__id__']) }}" method="POST" class="d-inline">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="btn btn-sm btn-outline-danger delete-btn">
                                           <i class="fa fa-trash"></i>
                                       </button>
                                   </form>
                               </div>
                            `.replace(/__id__/g, row.event_id);
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ]
            });

            // Confirmation de suppression avec SweetAlert
            $('#annoncesTable').on('click', '.delete-btn', function(event) {
                event.preventDefault(); // Empêche la soumission immédiate du formulaire

                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Confirmation',
                    text: 'Êtes-vous sûr de vouloir supprimer cet Evenement ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer!',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
