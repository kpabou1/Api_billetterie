<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="suivi des contrats, gestion des contrats, logiciel de gestion" />
    <meta name="description" content="Simplifiez la gestion de vos contrats avec notre logiciel avancé de suivi des contrats." />
    <meta name="author" content="Dev Logone" />

    <title>Suivi des Contrats</title>
    <link rel="shortcut icon" href="{{ asset('assets_2/logo.png') }}" type="image/svg+xml">

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_4/css/bootstrap.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_4/css/font-awesome.min.css') }}" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets_4/css/style.css') }}" rel="stylesheet" />
    <!-- Responsive style -->
    <link href="{{ asset('assets_4/css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section starts -->
        <header class="header_section">
            <div class="header_top">
                <div class="container-fluid">
                    <div class="contact_nav">
                        <a href="tel:+22891091656">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>Call : +228 91091656</span>
                        </a>
                        <a href="mailto:isidorekpabou4@gmail.com">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>Email : isidorekpabou4@gmail.com</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg custom_nav-container">
                        <a class="navbar-brand" href="index.html">
                            <span>Dev Logone</span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""> </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
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
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- end header section -->

        <!-- slider section -->
        <section class="slider_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-box">
                            <h1>
                                Suivi des <br> contrats <br> simplifié
                            </h1>
                            <p>
                                Automatisez le suivi des contrats, obtenez des rapports détaillés à chaque étape, économisez du temps et réduisez les risques. Notre solution vous aide à rester organisé et efficace.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="img-box">
                            <img src="{{ asset('assets_4/images/0.png') }}" alt="Suivi des contrats">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>

    <!-- feature section -->
    <section class="feature_section">
        <div class="container">
            <div class="feature_container">
                <div class="box">
                    <div class="img-box">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="48px" height="48px">
                            <path d="M19 2H5C3.9 2 3 2.9 3 4v16c0 1.1 0.9 2 2 2h14c1.1 0 2-0.9 2-2V4c0-1.1-0.9-2-2-2zM5 4h14v16H5V4zm7 14H7v-2h5v2zm5-4H7v-2h10v2zm0-4H7V8h10v2z"/>
                        </svg>
                        
                    </div>
                    <h5 class="name">Gestion de contrats</h5>
                </div>
                <div class="box active">
                    <div class="img-box">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M470.7 9.4c3 3.1 5.3 6.6 6.9 10.3s2.4 7.8 2.4 12.2l0 .1v0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3L310.6 214.6c-11.8 11.8-30.8 12.6-43.5 1.7L176 138.1 84.8 216.3c-13.4 11.5-33.6 9.9-45.1-3.5s-9.9-33.6 3.5-45.1l112-96c12-10.3 29.7-10.3 41.7 0l89.5 76.7L370.7 64H352c-17.7 0-32-14.3-32-32s14.3-32 32-32h96 0c8.8 0 16.8 3.6 22.6 9.3l.1 .1zM0 304c0-26.5 21.5-48 48-48H464c26.5 0 48 21.5 48 48V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V304zM48 416v48H96c0-26.5-21.5-48-48-48zM96 304H48v48c26.5 0 48-21.5 48-48zM464 416c-26.5 0-48 21.5-48 48h48V416zM416 304c0 26.5 21.5 48 48 48V304H416zm-96 80a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z" />
                        </svg>
                    </div>
                    <h5 class="name">Améliorer la performance</h5>
                </div>
                <div class="box">
                    <div class="img-box">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="48px" height="48px">
                            <path d="M19 3H5C3.9 3 3 3.9 3 5v14c0 1.1 0.9 2 2 2h14c1.1 0 2-0.9 2-2V5c0-1.1-0.9-2-2-2zM5 19V5h14v14H5zm3-9h2v5H8zm4-3h2v8h-2zm4 6h2v2h-2z"/>
                        </svg>
                        
                    </div>
                    <h5 class="name">Centralisation des données</h5>
                </div>
            </div>
        </div>
    </section>
    <!-- end feature section -->

    <!-- about section -->
    <section class="about_section layout_padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="detail-box">
                        <h4>Pourquoi utiliser notre logiciel de suivi de contrats ?</h4>
                        <p>Notre application est une solution web sécurisée, pilotée par une base de données, conçue pour le suivi et la gestion des contrats en ligne. Ses points forts comprennent :</p>
                        <ul>
                            <li>Disponibilité sur ordinateur de bureau, ordinateur portable, tablette ou téléphone</li>
                            <li>Système simple basé sur les transactions</li>
                            <li>Paramètres flexibles avec de nombreuses options</li>
                            <li>Rapports détaillés sur les contrats</li>
                            <li>Sécurité, cryptage et sauvegarde complète des données</li>
                            <li>Aucune limite quant au nombre de contrats ou de transactions</li>
                            <li>Capacités multi-utilisateurs</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="img-box">
                        <img src="{{ asset('assets_4/images/1.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->

    <!-- professional section -->
    <section class="professional_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="{{ asset('assets_4/images/00.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <h2>Pourquoi choisir notre logiciel de suivi des contrats ?</h2>
                        <p>
                            La gestion des contrats peut représenter un défi de taille ! Vous devez suivre les échéances, les renouvellements, et générer des rapports pour prendre des décisions éclairées. Notre logiciel offre la flexibilité dont vous avez besoin pour rationaliser ce processus.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end professional section -->

    <!-- service section -->
    <section class="service_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2> Logiciel de Suivi de Contrats : Éléments à Prendre en Compte </h2>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 mx-auto">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('assets_4/images/s8.png') }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>Flexibilité</h5>
                            <p>
                                Que vous soyez une entreprise, une organisation à but non lucratif, ou un cabinet juridique, vous avez besoin de flexibilité dans votre système de gestion des contrats. Recherchez des logiciels qui s'adaptent à vos besoins, et non l'inverse.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mx-auto">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('assets_4/images/s6.png') }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>Simplicité</h5>
                            <p>
                                Le logiciel de suivi des contrats idéal est aussi simple que puissant. L'interface doit être intuitive et conviviale, permettant une adoption rapide par vos équipes.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mx-auto">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('assets_4/images/s7.png') }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>Sécurité</h5>
                            <p>
                                La sécurité des données est primordiale. Assurez-vous que votre logiciel de gestion des contrats offre un cryptage robuste et des mesures de sécurité avancées pour protéger vos informations sensibles.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end service section -->

    <!-- info section -->
    <section class="info_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4 info_detail">
                    <h5>
                        À propos de nous
                    </h5>
                    <p>
                        Nous sommes une entreprise spécialisée dans la fourniture de solutions numériques innovantes, offrant des logiciels de gestion adaptés aux besoins des entreprises modernes.
                    </p>
                </div>
                <div class="col-md-4 info_contact">
                    <h5>
                        Contacts
                    </h5>
                    <div class="contact_nav">
                        <a href="tel:+22891091656">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>+228 91091656</span>
                        </a>
                        <a href="mailto:isidorekpabou4@gmail.com">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>isidorekpabou4@gmail.com</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 info_social">
                    <h5>
                        Suivez-nous
                    </h5>
                    <div class="social_box">
                        <a href="https://www.facebook.com/isidore.kpabou" target="_blank">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        
                        <a href="linkedin.com/in/isidore-kpabou-0b1496210" target="_blank">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end info section -->

    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <p>
                &copy; 2024 Tous droits réservés par
                <a href="https://siriusdigital.com">Isidore Kpabou</a>
            </p>
        </div>
    </footer>
    <!-- end footer section -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets_4/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_4/js/custom.js') }}"></script>
</body>

</html>
