@extends('layouts.welcome')

@section('title')
    {{ __('Liste de toutes les annonces') }}
@endsection

@section('content')
<main class="main">
    <!-- Page Title -->                      
    <div class="page-title" data-aos="fade" style="background-image: url('{{ asset('asset_7/assets/img/aff.jpg') }}');">
        <div class="container position-relative">
            <h1>Détatils de l' annonce</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('listeannonces') }}">Annonces</a></li>
                    <li class="current">Détails Annonce</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <section class="détails mt-header">
        <div class="container">
            <div class="card">
                <div class="card-body">
    
                    <div class="row">
                        <!-- Partie gauche - Contenu principal -->
                        <div class="col-md-8 mb-4 mb-md-0">
                            <!-- Contenu existant -->
                            <!-- Affichage du PDF -->
                            <div class="prose">
                                {!! $annonce->corps_annonce !!}
                            </div>
                        </div>
    
                        <!-- Partie droite - Informations supplémentaires -->
                        <div class="col-md-4 border-start">
                            <div class="bg-white p-4 rounded shadow-sm">
                                <div class="text-center mb-4">
                                    <img src="{{ asset('storage/' . $annonce->image_autorite_contractante) }}" alt="Logo"
                                         class="mx-auto img-fluid mb-3"
                                         onerror="this.onerror=null;this.src='{{ asset('assets_3/logo.png') }}';">
                                    <p class="text-primary fw-bold">{{ $annonce->objet_marche }}</p>
                                    <button onclick="window.open('{{ asset('storage/' . $annonce->ficher_annonce) }}', '_blank')"
                                            class="btn btn-primary mt-3">Télécharger le PDF</button>
                                </div>
    
                                <div class="text-start">
                                    <div class="mb-3">
                                        <p class="small text-muted">Nom Autorité Contractante</p>
                                        <p class="fw-semibold">{{ $annonce->nom_autorite_contractante }}</p>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <p class="small text-muted">Adresse Autorité Contractante</p>
                                        <p class="fw-semibold">{{ $annonce->adresse_autorite_contractante }}</p>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <p class="small text-muted">Lieu de Dépôt</p>
                                        <p class="fw-semibold">{{ $annonce->lieu_depot }}</p>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <p class="small text-muted">Garantie de Soumission</p>
                                        <p class="fw-semibold">{{ $annonce->garantie_soumission }}</p>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <p class="small text-muted">Source de Financement</p>
                                        <p class="fw-semibold">{{ $sourcefinance }}</p>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <p class="small text-muted">Date limite</p>
                                        <p class="fw-semibold">{{ $annonce->date_cloture }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
