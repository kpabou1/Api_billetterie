@extends('layouts.app')

@section('title')
    {{ __('Liste des Commandes') }}
@endsection

@section('content')
    <!-- Début du titre de la page -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-primary">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Liste des Commandes') }}</li>
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
            
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover w-100" id="ordersTable">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Numéro de Commande') }}</th>
                    <th scope="col">{{ __('Titre de l\'Événement') }}</th>
                    <th scope="col">{{ __('Prix') }}</th>
                    <th scope="col">{{ __('Type de Commande') }}</th>
                    <th scope="col">{{ __('Paiement') }}</th>
                    <th scope="col">{{ __('Date de Création') }}</th>
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

                table.ajax.url("{{ route('listeorders') }}?from_date=" + startDate + "&to_date=" + endDate).load();
                $('#filterModal').modal('hide');
            });

            // Initialiser DataTable
            table = $('#ordersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('listeorders') }}",
                columns: [
                    { data: 'order_id', name: 'order_id' },
                    { data: 'order_number', name: 'order_number' },
                    { data: 'event_title', name: 'event_title' },
                    { data: 'order_price', name: 'order_price' },
                    { data: 'order_type', name: 'order_type' },
                    { data: 'order_payment', name: 'order_payment' },
                    { data: 'created_at', name: 'created_at' },
                    { 
                        data: null,
                        render: function(data, type, row) {
                            return `
                               <div class="d-flex gap-2">
                                  
                                   <form action="{{ route('orders.destroy', '__id__') }}" method="POST" class="d-inline">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="btn btn-sm btn-outline-danger delete-btn">
                                           <i class="fa fa-trash"></i>
                                       </button>
                                   </form>
                               </div>
                            `.replace(/__id__/g, row.order_id);
                        }
                    }
                ],
                order: [[1, 'asc']]
            });

            // Confirmation de suppression avec SweetAlert
            $('#ordersTable').on('click', '.delete-btn', function(event) {
                event.preventDefault();

                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Confirmation',
                    text: 'Êtes-vous sûr de vouloir supprimer cette commande ?',
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
