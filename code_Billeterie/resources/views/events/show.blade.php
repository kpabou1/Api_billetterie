@extends('layouts.app')

@section('title', __('Détails de l\'annonce'))

@section('content')

    <!-- Start page title -->
    <ul class="flex space-x-2 rtl:space-x-reverse mb-4">
        <li>
            <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <a href="{{ route('annonces.index') }}" class="text-primary hover:underline">Annonces</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Détails de l'annonce</span>
        </li>
    </ul>


    <div class="card">
        <div class="card-body">

            <div class="flex flex-col md:flex-row">
                <!-- Partie gauche - Contenu principal -->
                <div class="w-full md:w-3/5 md:pr-8 mb-8 md:mb-0">
                    <!-- Contenu existant -->
                    <!-- Affichage du PDF -->
                    <div class="prose">
                        {!! $annonce->corps_annonce !!}
                    </div>
                </div>

                <!-- Partie droite - Informations supplémentaires -->
                <div class="w-full md:w-2/5 md:pl-8 border-l-2 border-gray-300">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-center mb-6">
                            <img src="{{ asset('storage/' . $annonce->image_autorite_contractante) }}" alt="Logo"
                                class="mx-auto h-36 object-cover mb-4"
                                onerror="this.onerror=null;this.src='{{ asset('assets_3/logo.png') }}';">
                            <p class="text-blue-600 font-semibold">{{ $annonce->objet_marche }}</p>
                            <button onclick="window.open('{{ asset('storage/' . $annonce->ficher_annonce) }}', '_blank')"
                                class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Télécharger le PDF</button>
                        </div>

                        <div class="text-left space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700">Date de publication</p>
                                <p class="text-lg font-semibold">{{ $annonce->date_publication }}</p>
                            </div>
                            <hr>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Nom Autorité Contractante</p>
                                <p class="text-lg font-semibold">{{ $annonce->nom_autorite_contractante }}</p>
                            </div>
                            <hr>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Type de marche</p>
                                <p class="text-lg font-semibold">{{ $annonce->categoriemarch->name }}</p>
                            </div>
                            
                            <hr>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Adresse Autorité Contractante</p>
                                <p class="text-lg font-semibold">{{ $annonce->adresse_autorite_contractante }}</p>
                            </div>
                            <hr>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Lieu de Dépôt</p>
                                <p class="text-lg font-semibold">{{ $annonce->lieu_depot }}</p>
                            </div>
                            <hr>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Garantie de Soumission</p>
                                <p class="text-lg font-semibold">{{ $annonce->garantie_soumission }}</p>
                            </div>
                            
                            
                            <hr>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Source de Financement</p>
                                <p class="text-lg font-semibold">
                                    {{ optional($sourcefinance)->name ?? $sourcefinance }}
                                </p>
                                                            </div>
                            <hr>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Date limite</p>
                                <p class="text-lg font-semibold">{{ $annonce->date_cloture }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.worker.min.js"></script>
@endsection
