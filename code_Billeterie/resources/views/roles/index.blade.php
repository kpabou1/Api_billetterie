@extends('layouts.app')

@section('title')
    {{ __('Roles') }}
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Liste de tous les rôles</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Roles list</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- end page title -->

    @include('flash-message')

    <div class="card-header"></div>
    <br>
    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-plus"></i> {{__('Create')}}
    </a>

    <button class="btn btn-info btn-sm float-right mr-2" data-toggle="modal" data-target="#filterModal">
        <i class="fa fa-filter"></i> {{__('Filter by Date')}}
    </button>
    <br>
    <br>

    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="rolestable">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom du rôle</th>
                    <th scope="col">Permissions</th>
                    <th scope="col">Date de création</th>
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
                    <h5 class="modal-title" id="filterModalLabel">{{__('Filter by Date')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="startDate">{{__('Start Date')}}</label>
                        <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate">{{__('End Date')}}</label>
                        <input type="date" class="form-control" id="endDate">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="button" class="btn btn-primary" id="filterBtn">{{__('Filter')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var table;

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            table = $('#rolestable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'permissions', name: 'permissions' },
                    { data: 'created_at', name: 'created_at' },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `
                                <a href="{{ route('roles.show', ['id' => '__id__']) }}" class="btn btn-info btn-sm">
                                    <i class="bx bxs-bullseye"></i>
                                </a>
                                <a href="{{ route('roles.edit', ['id' => '__id__']) }}" class="btn btn-warning btn-sm">
                                    <i class="bx bxs-edit"></i>
                                </a>
                                <form action="{{ route('roles.destroy', ['id' => '__id__']) }}" method="POST" style="display:inline">
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
            $('#filterBtn').on('click', function () {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                // Mettez à jour la requête Ajax avec les dates sélectionnées
                table.ajax.url("{{ route('roles.index') }}?from_date=" + startDate + "&to_date=" + endDate).load();
                $('#filterModal').modal('hide');
            });

            // Gestion de la boîte de dialogue de confirmation avant la suppression
            $('#rolestable').on('click', '.delete-btn', function () {
                var form = $(this).closest('form');
                var roleId = form.find('input[name="id"]').val();

                Swal.fire({
                    title: 'Confirmation',
                    text: 'Êtes-vous sûr de vouloir supprimer ce rôle ?',
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
