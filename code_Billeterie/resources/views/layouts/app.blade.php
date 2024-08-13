<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <!-- Liens CSS de base -->
    <link rel="stylesheet" href="{{ asset('assets_2/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_2/assets/vendors/css/vendor.bundle.base.css') }}">

    <!-- Plugin CSS pour cette page -->
    <link rel="stylesheet" href="{{ asset('assets_2/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_2/assets/vendors/jvectormap/jquery-jvectormap.css') }}">

    <!-- Styles de mise en page -->
    <link rel="stylesheet" href="{{ asset('assets_2/assets/css/demo/style.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('app.logo')) }}">

    <!-- Select2 CSS (pour les sélecteurs améliorés) -->
    <link href="{{ asset('assets/jsdata/css/select2.min.css') }}" rel="stylesheet">

    <!-- CSS pour l'input de téléphone international -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

    <!-- CSS pour Perfect Scrollbar (pour des barres de défilement améliorées) -->
    <link rel="stylesheet" type="text/css" media="screen"
        href="{{ asset('assets_3/assets/css/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets_3/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets_3/assets/css/animate.css') }}">

    <!-- Tailwind CSS (pour des utilitaires de style) -->
    <link href="{{ asset('Tailwindcss/tailwind.min.css') }}" rel="stylesheet">


    <!-- Font Awesome CSS (pour les icônes) -->
    <link href="{{ asset('Icones/fontawesome/css/all.min.css') }}" rel="stylesheet">


    
    

    <!-- DataTables CSS (pour les tableaux interactifs) -->
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.css') }}">

    <!-- Bootstrap JS (pour les composants Bootstrap) -->
    <script src="{{ asset('assets/jsdata/js/bootstrap.min.js') }}"></script>

    <!-- SweetAlert JS (pour les alertes élégantes) -->
    <script src="{{ asset('assets/jsdata/js/sweetalert2@11') }}"></script>

    <!-- FileSaver.js (pour sauvegarder des fichiers côté client) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <!-- Select2 JS (pour les sélecteurs améliorés) -->
    <script src="{{ asset('assets/jsdata/js/select2.min.js') }}"></script>

    <!-- Perfect Scrollbar JS (pour des barres de défilement améliorées) -->
    <script src="{{ asset('assets_3/assets/js/perfect-scrollbar.min.js') }}"></script>

    <!-- Popper.js (pour les pop-ups et les infobulles) -->
    <script defer="" src="{{ asset('assets_3/assets/js/popper.min.js') }}"></script>

    <!-- Tippy.js (pour les infobulles améliorées) -->
    <script defer="" src="{{ asset('assets_3/assets/js/tippy-bundle.umd.min.js') }}"></script>

    <!-- SweetAlert JS (pour les alertes élégantes) -->
    <script defer="" src="{{ asset('assets_3/assets/js/sweetalert.min.js') }}"></script>

    <!-- jQuery (pour faciliter la manipulation du DOM) -->
    <script type="text/javascript" charset="utf8" src="{{ asset('DataTables/jquery.min.js') }}"></script>

    <!-- DataTables JS (pour les tableaux interactifs) -->
    <script type="text/javascript" charset="utf8" src="{{ asset('DataTables/datatables.js') }}"></script>

    <!-- Style personnalisé pour DataTable -->
    <style>
        /* Style personnalisé pour DataTable */
        #myTables {
            background-color: #e0f7fa;
            /* Fond bleu clair */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5em 1em;
            margin-left: 2px;
            color: white !important;
            background-color: #007bff !important;
            border: 1px solid #007bff;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #0056b3 !important;
            border: 1px solid #0056b3;
        }

        .dataTables_wrapper .dataTables_length select {
            width: auto;
            display: inline-block;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: auto;
            display: inline-block;
          
        }
    </style>
</head>

<body>

    <script src="{{ asset('assets_2/assets/js/preloader.js') }}"></script>

    <div class="body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @if (Route::has('login'))
            @auth

                @include('layouts.partials.left_sidebar')
           
            @endauth
        @endif


        <!-- partial -->
        <div class="main-wrapper mdc-drawer-app-content">
            <!-- partial:partials/_navbar.html -->

            @if (Route::has('login'))
                @auth

                    @include('layouts.partials.principal_header')
                
                @endauth
            @endif

            <!-- partial -->
            <div class="page-wrapper mdc-toolbar-fixed-adjust">
                <main class="content-wrapper">

                    @yield('content')

                </main>
                <!-- partial:partials/_footer.html -->
                <footer>
                    <div class="mdc-layout-grid">
                        <div class="mdc-layout-grid__inner">
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                <span class="text-center text-sm-left d-block d-sm-inline-block tx-14">Copyright © <a
                                        href="https://isidoreportfolio.netlify.app/"
                                        target="_blank">https://isidoreportfolio.netlify.app
                                    </a>2024</span>
                            </div>
                            <div
                                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex justify-content-end">
                                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center tx-14"> <a
                                        href="https://isidoreportfolio.netlify.app/" target="_blank"> Isidore Dev </a>
                                    portfolio :   https://isidoreportfolio.netlify.app</span>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
        </div>
    </div>




    <!-- plugins:js -->
    <script src="{{ asset('assets_2/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('assets_2/assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets_2/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets_2/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('assets_2/assets/js/material.js') }}"></script>
    <script src="{{ asset('assets_2/assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets_2/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page-->





    <!--à vérifier -->
    <script src="{{ asset('BoiteDIalogue/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('assets_2/assets/js/dashboard.js') }}"></script>

    <!-- Bootstrap JS (bundle incluant Popper.js) -->
    <script src="{{ asset('BoiteDIalogue/bootstrap.bundle.min.js') }}"></script>


    <!-- Fin -->



    <!--Today -->
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.css') }}">

    <script type="text/javascript" charset="utf8" src="{{ asset('DataTables/datatables.min.js') }}"></script>

    <!-- Fin today -->


</body>





<!--Today -->

<script type="text/javascript" charset="utf8" src="{{ asset('DataTables/datatables.min.js') }}"></script>

<!-- Fin today -->


<script>
    $(document).ready(function() {
        $('#myTables').DataTable({
            // Enable responsive layout
            responsive: true,
            // Customize the length menu
            lengthMenu: [10, 25, 50, 75, 100],
            // Customize the language options
            language: {
                lengthMenu: "Afficher _MENU_ enregistrements par page",
                zeroRecords: "Aucun enregistrement trouvé",
                info: "Affichage de la page _PAGE_ sur _PAGES_",
                infoEmpty: "Aucun enregistrement disponible",
                infoFiltered: "(filtré à partir de _MAX_ enregistrements au total)",
                paginate: {
                    first: "Premier",
                    last: "Dernier",
                    next: "Suivant",
                    previous: "Précédent"
                },
                search: "Recherche:",
                processing: "Traitement en cours...",
                loadingRecords: "Chargement en cours...",
                emptyTable: "Aucune donnée disponible dans le tableau"
            }
        });
    });
</script>


</html>
