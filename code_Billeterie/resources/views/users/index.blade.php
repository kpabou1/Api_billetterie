@extends('layouts.app')

@section('title')
    {{ __('Users') }}
@endsection

@section('content')
    <!-- Début du titre de la page -->
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>{{ __('Liste des utilisateurs') }}</span>
        </li>
    </ul>
    <br>
    <!-- Fin du titre de la page -->

    @include('flash-message')
    <div class="flex justify-between items-center mb-4">
        <div class="card-header"></div>
        <div class="flex items-center">
            <button class="btn btn-info btn-sm" id="filterBtn">
                <i class="fa fa-filter"></i> {{ __('Filtrer par date') }}
            </button>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm ml-2">
                <i class="fa fa-plus"></i> {{ __('Ajouter utilisateur') }}
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <div class="card-header flex justify-end">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importModal">
                <i class="fa fa-upload"></i> {{__('Importer')}}
            </button>
            <button class="btn btn-success btn-sm ml-2" data-toggle="modal" data-target="#exportModal">
                <i class="fa fa-upload"></i> {{__('Exporter')}}
            </button>
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
                    <div class="modal-footer flex justify-between">
                        <button type="button" class="btn btn-success" onclick="window.location='{{ route('nationalites.export', ['format' => 'xlsx']) }}'">
                            <i class="fa fa-file-excel"></i> {{__('Export Excel')}}
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Annuler')}}</button>
                    </div>
                </div>
            </div>
        </div>
        
        <table class="table-auto w-full" id="userstable">
            <thead class="bg-gray-200">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Last Name') }}</th>
                    <th scope="col">{{ __('First Name') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('Phone Code') }}</th>
                    <th scope="col">{{ __('Phone Number') }}</th>
                    <th scope="col">{{ __('Username') }}</th>
                    <th scope="col">{{ __('Creation Date') }}</th>
                    <th scope="col">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Modal de filtre -->
    <div id="filterModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!-- Titre du Modal -->
                <div class="modal-header">
                    <h5 class="modal-title text-2xl font-semibold text-gray-800">{{ __('Filtrer par date') }}</h5>
                    <button type="button" class="modal-close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Corps du Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="startDate" class="text-gray-700">{{ __('Date de début') }}</label>
                        <input type="date" class="form-input mt-1 block w-full" id="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate" class="text-gray-700">{{ __('Date de fin') }}</label>
                        <input type="date" class="form-input mt-1 block w-full" id="endDate">
                    </div>
                </div>
                <!-- Pied du Modal -->
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" id="closeModal">{{ __('Fermer') }}</button>
                    <button type="button" class="btn btn-primary" id="applyFilter">{{ __('Filtrer') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var table;

        $(document).ready(function() {
            // Ouvrir le modal de filtre
            $('#filterBtn').on('click', function() {
                $('#filterModal').removeClass('hidden');
            });

            // Fermer le modal de filtre
            $('.modal-close, #closeModal').on('click', function() {
                $('#filterModal').addClass('hidden');
            });

            // Appliquer le filtre et recharger les données du tableau
            $('#applyFilter').on('click', function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                table.ajax.url("{{ route('users.index') }}?from_date=" + startDate + "&to_date=" + endDate).load();
                $('#filterModal').addClass('hidden');
            });

            // Initialisation de la table DataTable
            table = $('#userstable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'lastname', name: 'lastname' },
                    { data: 'firstname', name: 'firstname' },
                    { data: 'email', name: 'email' },
                    { data: 'indicatiftel', name: 'indicatiftel' },
                    { data: 'telephone', name: 'telephone' },
                    { data: 'username', name: 'username' },
                    { data: 'created_at', name: 'created_at' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <div class="flex gap-4 items-center">
                                    <a href="{{ route('users.edit', ['id' => '__id__']) }}" class="hover:text-info">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5">
                                            <path
                                                opacity="0.5"
                                                d="M22 10.5V12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2H13.5"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                            ></path>
                                            <path
                                                d="M17.3009 2.80624L16.652 3.45506L10.6872 9.41993C10.2832 9.82394 10.0812 10.0259 9.90743 10.2487C9.70249 10.5114 9.52679 10.7957 9.38344 11.0965C9.26191 11.3515 9.17157 11.6225 8.99089 12.1646L8.41242 13.9L8.03811 15.0229C7.9492 15.2897 8.01862 15.5837 8.21744 15.7826C8.41626 15.9814 8.71035 16.0508 8.97709 15.9619L10.1 15.5876L11.8354 15.0091C12.3775 14.8284 12.6485 14.7381 12.9035 14.6166C13.2043 14.4732 13.4886 14.2975 13.7513 14.0926C13.9741 13.9188 14.1761 13.7168 14.5801 13.3128L20.5449 7.34795L21.1938 6.69914C22.2687 5.62415 22.2687 3.88124 21.1938 2.80624C20.1188 1.73125 18.3759 1.73125 17.3009 2.80624Z"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            ></path>
                                            <path
                                                opacity="0.5"
                                                d="M16.6522 3.45508C16.6522 3.45508 16.7333 4.83381 17.9499 6.05034C19.1664 7.26687 20.5451 7.34797 20.5451 7.34797M10.1002 15.5876L8.4126 13.9"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            ></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('users.show', ['id' => '__id__']) }}" class="hover:text-primary">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                            <path
                                                opacity="0.5"
                                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            ></path>
                                            <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('users.destroy', ['id' => '__id__']) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                                <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                <path
                                                    d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                ></path>
                                                <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                <path
                                                    opacity="0.5"
                                                    d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                ></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            `.replace(/__id__/g, row.id);
                        }
                    }
                ],
                order: [[1, 'asc']]
            });

            // Gestion de la boîte de dialogue de confirmation avant la suppression
            $('#userstable').on('click', '.delete-btn', function(event) {
                event.preventDefault(); // Empêcher la soumission immédiate du formulaire

                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Confirmation',
                    text: 'Êtes-vous sûr de vouloir supprimer cet utilisateur ?',
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
