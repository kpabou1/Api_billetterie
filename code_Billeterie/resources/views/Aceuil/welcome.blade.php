<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>{{ config('app.name') }}</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('app.logo')) }}">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('assets_8/css/theme.css') }}" rel="stylesheet" />

</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block"
            data-navbar-on-scroll="data-navbar-on-scroll">
          
            <div class="container"><a class="navbar-brand" href="index.html"><img
                        src="{{ asset(config('app.logo')) }}" width="200" alt="logo" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon">
                    </span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">

                    </ul>

                   
                        @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                                <span class="text text-2" aria-hidden="true">Tableau de bord</span>
                            </a>
                        @else
                            <div class="btn-box">
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    <span class="text text-1">Connexion</span>
                                </a>
                            </div>
                        @endauth
                    @endif

                </div>
            </div>
        </nav>
        <section class="py-xxl-10 pb-0" id="home">
            @php
                $backgroundImage = \App\Models\BackgroundImage::first();
                //dd($backgroundImage);
            @endphp

                <div class="bg-holder bg-size"
                style="background-image:url('{{ $backgroundImage ? asset('storage/'.$backgroundImage->image_path_welcome) : asset('assets_8/img/gallery/hero-bg.png') }}');background-position:top center;background-size:cover;">
                </div>
                            <!--/.bg-holder-->

            <div class="container">
                <div class="row min-vh-xl-100 min-vh-xxl-25">
                    <div class="col-md-5 col-xl-6 col-xxl-7 order-0 order-md-1 text-end">

                        <img src="{{ $backgroundImage && $backgroundImage->image_path_login ? asset('storage/' . $backgroundImage->image_path_login) : asset('assets_8/img/gallery/hero.jpeg') }}" alt="Description de l'image" style="width: 600px; height: auto; border-radius: 15px;">


                    </div>
                    <div class="col-md-75 col-xl-6 col-xxl-5 text-md-start text-center py-6">
                        <h1 class="lh-lg fw-bold mb-4 text-light font-sans-serif">

                            Suivie 
                            <br>
                            Contrat



                        </h1>


                        <p class="lh-lg fw-bold mb-4 text-light font-sans-serif">Automatisez le suivi des contrats,
                            obtenez des rapports détaillés à chaque étape, économisez du temps et réduisez les risques.
                            Notre solution vous aide à rester organisé et efficace.


                    </div>
                </div>
            </div>
        </section>


        <!-- <section> close ============================-->
        <!-- ============================================-->


        <section class="py-0 bg-secondary">
            <div class="bg-holder opacity-25"
                style="background-image:url('{{ asset('assets_8/img/gallery/dot-bg.png') }}');background-position:top left;margin-top:-3.125rem;background-size:auto;">
            </div>
            <!--/.bg-holder-->



            <!-- ============================================-->
            <!-- <section> begin ============================-->
            <section class="py-0 bg-primary">

                <div class="container">
                    <div class="row justify-content-md-between justify-content-evenly py-4">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
                            <p class="fs--1 my-2 fw-bold text-200">Tous droits réservés&copy; Isidore Kpabou, 2024</p>
                        </div>
                        <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
                            <a href="tel:+22891161396">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>+228 91161396</span>
                            </a>
                            
                        </div>
                        <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
                            <a href="mailto:isidorekpabou4@gmail.com">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>isidorekpabou4@gmail.com</span>
                            </a>
                        </a>
                        </div>
                        <div class="col-12 col-sm-8 col-md-6">
                            <p class="fs--1 my-2 text-center text-md-end text-200"> Réalisé par&nbsp;
                                <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="12"
                                    height="12" fill="#F95C19" viewBox="0 0 16 16">
                                    <path
                                        d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z">
                                    </path>
                                </svg>&nbsp;&nbsp;<a class="fw-bold text-info"
                                    href="https://isidoreportfolio.netlify.app/" target="_blank">Isidore Kpabou </a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end of .container-->

            </section>
            <!-- <section> close ============================-->
            <!-- ============================================-->


        </section>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('assets_8/vendors/@popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('assets_8/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets_8/vendors/is/is.min.js') }}"></script>
    <script src="https://scripts.sirv.com/sirvjs/v3/sirv.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets_8/js/theme.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fjalla+One&amp;family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100&amp;display=swap"
        rel="stylesheet">
</body>

</html>
