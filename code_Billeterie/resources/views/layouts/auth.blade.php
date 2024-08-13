<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('assets_2/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_2/assets/vendors/css/vendor.bundle.base.css') }}">

    <!-- Plugin CSS pour cette page -->
    <link rel="stylesheet" href="{{ asset('assets_2/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_2/assets/vendors/jvectormap/jquery-jvectormap.css') }}">

    <!-- Styles de mise en page -->
    <link rel="stylesheet" href="{{ asset('assets_2/assets/css/demo/style.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets_8/img/favicons/logo.png') }}">

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

    @php
    $backgroundImage = \App\Models\BackgroundImage::first();
    $imagePath = $backgroundImage ? asset('storage/' . $backgroundImage->image_path_welcome) : asset('assets/img/default-background.png');
@endphp

    <style>
        .background-image {
            background-image: url('{{ $imagePath }}'); /* Utilise l'URL récupérée depuis la base de données */
            background-size: cover;
            background-position: center;
        }
        .custom-search {
            margin-bottom: 10px;
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-blue-100 background-image">
    <div class="bg-white shadow-lg rounded-lg flex max-w-4xl">
        <div class="w-1/2 bg-blue-300 rounded-l-lg">
            <img src="{{ $backgroundImage && $backgroundImage->image_path_login ? asset('storage/' . $backgroundImage->image_path_login) : asset('asset_7/assets/img/marche.jpg') }}" alt="Sign Up Image" class="h-full w-full object-cover rounded-l-lg opacity-70">

                
        </div>
        <div class="w-1/2 p-8">
            @include('flash-message')
        @yield('content')

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        $(document).ready(function() {
            const phoneInputField = document.querySelector("#phone");
            const phoneInput = window.intlTelInput(phoneInputField, {
                initialCountry: "auto",
                geoIpLookup: function(success, failure) {
                    fetch('https://ipinfo.io/json?token=<your_token>')
                        .then(response => response.json())
                        .then(data => success(data.country))
                        .catch(() => success("us"));
                },
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                autoPlaceholder: "aggressive",
                separateDialCode: true
            });

            // Add search input to the country list dropdown
            const countryList = document.querySelector(".iti__country-list");
            const searchInput = document.createElement("input");
            searchInput.classList.add("custom-search", "iti__country-list--search");
            searchInput.placeholder = "Search country";
            countryList.insertBefore(searchInput, countryList.firstChild);

            // Filter country list based on search input
            searchInput.addEventListener("input", function() {
                const searchValue = searchInput.value.toLowerCase();
                const countryItems = countryList.querySelectorAll(".iti__country");

                countryItems.forEach(function(item) {
                    const countryName = item.getAttribute("data-country-name").toLowerCase();
                    const dialCode = item.getAttribute("data-dial-code");

                    if (countryName.includes(searchValue) || dialCode.includes(searchValue)) {
                        item.style.display = "";
                    } else {
                        item.style.display = "none";
                    }
                });
            });

            phoneInputField.addEventListener("open:countrydropdown", function() {
                searchInput.value = '';
                const countryItems = countryList.querySelectorAll(".iti__country");
                countryItems.forEach(function(item) {
                    item.style.display = "";
                });
                searchInput.focus();
            });

            phoneInputField.addEventListener("countrychange", function() {
                document.getElementById("country-code").value = '+' + phoneInput.getSelectedCountryData().dialCode;
            });


            /*document.getElementById("signup-form").addEventListener("submit", function(event) {
                event.preventDefault();
                const phoneNumber = phoneInput.getNumber();
                const countryCode = phoneInput.getSelectedCountryData().dialCode;
                const numberOnly = phoneNumber.replace(`+${countryCode}`, '');

                alert(`Country Code: +${countryCode}\nPhone Number: ${numberOnly}`);
                // You can now send the countryCode and numberOnly to your server
            });*/
        });
    </script>
</body>

</html>
