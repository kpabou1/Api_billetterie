<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('assets_3/logo.png') }}" type="image/svg+xml">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('asset_7/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset_7/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('asset_7/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('asset_7/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset_7/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('asset_7/assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('asset_7/assets/css/style_welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('asset_7/assets/boot/css/bootstrap.min.css') }}" rel="stylesheet">

    <script src="{{ asset('asset_7/assets/boot/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>




    <!-- Inclure SweetAlert CSS et JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles personnalisés -->
    <style>
        .header-background {
            background: linear-gradient(to right, #6a0d7c, #b70e0a);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .event-card {
            border: none;
            transition: transform 0.2s;
        }
        .event-card:hover {
            transform: scale(1.05);
        }
        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        footer a {
            color: #b7b7b7;
        }
        .container-content {
            min-height: 80vh;
        }
    </style>
</head>
<body>

    <!-- Barre de Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Dev Isidore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listeevents') }}">Événements</a>
                    </li>
                    
                    @if (Route::has('login'))
                    <li class="nav-item">
                        @auth
                            <a class="nav-link btn btn-outline-primary me-2" href="{{ route('dashboard') }}">Dashboard</a>
                        @else
                            <a class="nav-link btn btn-outline-primary me-2" href="{{ route('login') }}">Se connecter</a>
                            @if (Route::has('register'))
                                <a class="nav-link btn btn-primary" href="{{ route('register') }}">Ouvrir un compte</a>
                            @endif
                        @endauth
                    </li>
                @endif
                
                </ul>
            </div>
        </div>
    </nav>

    <!-- En-tête avec un arrière-plan -->
    <header class="header-background">
        <div class="container">
            <h1>N°1 DE LA BILLETTERIE ÉVÉNEMENTIELLE</h1>
            <p>Achetez vos tickets :</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#" class="text-white">En ligne</a></li>
                <li class="list-inline-item"><a href="#" class="text-white">En point de vente physique</a></li>
                <li class="list-inline-item"><a href="#" class="text-white">Par téléphone ou WhatsApp</a></li>
            </ul>
        </div>
    </header>

    


    @yield('content')




    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>&copy; 2024 Dev Isidore. Tous droits réservés.</p>
            <p><a href="#">Politique de confidentialité</a> | <a href="#">Conditions d'utilisation</a></p>
        </div>
    </footer>


     <!-- Scroll Top -->
     <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Modals -->

<!-- Vendor JS Files -->

<script src="{{ asset('asset_7/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('asset_7/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('asset_7/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('asset_7/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('asset_7/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('asset_7/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<!-- Main JS File -->
<script src="{{ asset('asset_7/assets/js/main.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.carousel .carousel-item');

        items.forEach((el) => {
            const minPerSlide = 1;
            let next = el.nextElementSibling;
            for (let i = 1; i < minPerSlide; i++) {
                if (!next) {
                    next = items[0];
                }
                let cloneChild = next.cloneNode(true);
                el.appendChild(cloneChild.children[0]);
                next = next.nextElementSibling;
            }
        });
    });
</script>

    <!-- JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

