@extends('layouts.app')

@section('title')
    {{__('Professions')}}
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Liste de toutes les professions</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboards</a></li>
                        <li class="breadcrumb-item active">listes des Professions </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- end page title -->

    @include('flash-message')
    <div class="card-header">
        <div class="float-right">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importModal">
                <i class="fa fa-upload"></i> {{__('Importer')}}
            </button>
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exportModal">
                <i class="fa fa-upload"></i> {{__('Exporter')}}
            </button>
        </div>
    </div>

    <!-- Export Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Exporter des données')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('Souhaitez vous exporter vos données en excel ?')}}</p>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-success" onclick="window.location='{{ route('professions.export', ['format' => 'xlsx']) }}'">
                        <i class="fa fa-file-excel"></i> {{__('Export Excel')}}
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Annuler')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">{{__('Importer des données')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('professions.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="importFile">{{__('Sélectionnez un fichier Excel')}}</label>
                            <input type="file" class="form-control-file" id="importFile" name="file" required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('Importer')}}</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Fermer')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-header"></div>
    <br>
    <a href="{{ route('professions.create') }}" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-plus"></i> {{__('Créer')}}
    </a>

    <button class="btn btn-info btn-sm float-right mr-2" data-toggle="modal" data-target="#filterModal">
        <i class="fa fa-filter"></i> {{__('Filtrer par Date')}}
    </button>
    <br>
    <br>

    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="professionstable">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Profession</th>
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
                    <h5 class="modal-title" id="filterModalLabel">{{__('Filtrer par Date')}}</h5>
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

            table = $('#professionstable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('professions.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'code', name: 'code'},
                    {data: 'libelle', name: 'libelle'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `
                                <a href="{{ route('professions.show', ['id' => '__id__']) }}" class="btn btn-info btn-sm">
                                    <i class="bx bxs-bullseye"></i>
                                </a>
                                <a href="{{ route('professions.edit', ['id' => '__id__']) }}" class="btn btn-warning btn-sm">
                                    <i class="bx bxs-edit"></i>
                                </a>
                                <form action="{{ route('professions.destroy', ['id' => '__id__']) }}" method="POST"
                                      style="display:inline">
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
                table.ajax.url("{{ route('professions.index') }}?from_date=" + startDate + "&to_date=" + endDate).load();
                $('#filterModal').modal('hide');
            });

            // Gestion de la boîte de dialogue de confirmation avant la suppression
            $('#professionstable').on('click', '.delete-btn', function () {
                var form = $(this).closest('form');
                var professionId = form.find('input[name="id"]').val();

                Swal.fire({
                    title: 'Confirmation',
                    text: 'Êtes-vous sûr de vouloir supprimer cette profession ?',
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
