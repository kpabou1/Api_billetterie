@extends('layouts.app')

@section('title')
    {{ __("Numéros d'Identification Fiscale") }}
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Liste des Numéros d'Identification Fiscale</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item active">Numéros d'Identification Fiscale</li>
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

    <br>
    <br>

    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="numeros_identification_fiscal-table">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIF</th>
                    <th scope="col">Statut NIF</th>
                    <th scope="col">Type Nomenclature</th>
                    <th scope="col">Nom contribuable</th>
                    <th scope="col">Prénom contribuable</th>
                    <th scope="col">Date de création</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script type="text/javascript">
        var table;

        $(document).ready(function() {
            table = $('#numeros_identification_fiscal-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('numeros_identification_fiscal.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nif', name: 'nif' },
                    { data: 'status', name: 'status' },
                    { data: 'nomenclature.type_contribuable', name: 'nomenclature.type_contribuable' },
                    {
                        data: 'particulier.user.lastname',
                        name: 'particulier.user.lastname',
                        defaultContent: '' // Définit une valeur par défaut (chaîne vide) pour la colonne
                    },
                    {
                        data: 'particulier.user.firstname',
                        name: 'particulier.user.firstname',
                        defaultContent: '' // Définit une valeur par défaut (chaîne vide) pour la colonne
                    },
                    { data: 'created_at', name: 'created_at' },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `
                                <a href="{{ route('numeros_identification_fiscal.show', '__id__') }}" class="btn btn-info btn-sm">
                                    <i class="bx bxs-bullseye"></i> Voir
                                </a>
                                
                                <form action="{{ route('numeros_identification_fiscal.destroy', '__id__') }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn">
                                        <i class="bx bxs-trash"></i> Supprimer
                                    </button>
                                </form>
                            `.replace(/__id__/g, row.id);
                        }
                    }
                ],
            });

            // Gestion de la boîte de dialogue de confirmation avant la suppression
            $('#numeros_identification_fiscal-table').on('click', '.delete-btn', function() {
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Confirmation',
                    text: 'Êtes-vous sûr de vouloir supprimer ce numéro d\'identification fiscal ?',
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
