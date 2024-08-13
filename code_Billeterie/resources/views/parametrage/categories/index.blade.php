@extends('layouts.app')

@section('title', __('Categories'))

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{__('Liste des Catégories')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboards</a></li>
                        <li class="breadcrumb-item active">Catégories liste</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- end page title -->

    @include('flash-message')

    <div class="card-header">
    </div>
    <br>
    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-plus"></i> {{__('Créer')}}
    </a>

    <button class="btn btn-info btn-sm float-right mr-2" data-toggle="modal" data-target="#filterModal">
        <i class="fa fa-filter"></i> {{__('Filtrer par Date')}}
    </button>
    <br>
    <br>
    <div>

    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="categorieTable">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">{{__('Filtrer par Date')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="startDate">{{__('Date de début')}}</label>
                        <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate">{{__('Date de fin')}}</label>
                        <input type="date" class="form-control" id="endDate">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Fermer')}}</button>
                    <button type="button" class="btn btn-primary" id="filterBtn">{{__('Filtrer')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var table;

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            table = $('#categorieTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'libelle', name: 'libelle' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <a href="{{ route('categories.show', ['id' => '__id__']) }}" class="btn btn-info btn-sm">
                                    <i class="bx bxs-bullseye"></i>
                                </a>
                                <a href="{{ route('categories.edit', ['id' => '__id__']) }}" class="btn btn-warning btn-sm">
                                    <i class="bx bxs-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', ['id' => '__id__']) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn">
                                        <i class="bx bxs-trash"></i>
                                    </button>
                                </form>
                            `.replace(/__id__/g, row.id);
                        }
                    }
                ],
                order: [[1, 'asc']]
            });

            // Bouton pour ouvrir le modal de filtre
            $('#filterBtn').on('click', function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                // Mettez à jour la requête Ajax avec les dates sélectionnées
                table.ajax.url("{{ route('categories.index') }}?from_date=" + startDate + "&to_date=" + endDate).load();
                $('#filterModal').modal('hide');
            });

            // Gestion de la boîte de dialogue de confirmation avant la suppression
            $('#categorieTable').on('click', '.delete-btn', function() {
                var form = $(this).closest('form');
                var categorieId = form.find('input[name="id"]').val();

                Swal.fire({
                    title: 'Confirmation',
                    text: 'Êtes-vous sûr de vouloir supprimer cette catégorie ?',
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
