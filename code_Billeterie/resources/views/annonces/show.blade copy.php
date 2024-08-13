@extends('layouts.app')

@section('title', __('Détails de l\'annonce'))

@section('content')

<!-- Start page title -->
<ul class="flex space-x-2 rtl:space-x-reverse">
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
<br>

<div class="flex flex-col md:flex-row">
    <!-- Partie gauche - Contenu principal -->
    <div class="w-full md:w-4/5 md:pr-4 mb-4 md:mb-0">
        <!-- Contenu existant -->
        <h1 class="text-xl font-bold mb-4">Contenu du PDF</h1>
        <!-- Affichage du PDF -->
        <div class="bg-gray-100 p-4 rounded shadow h-full overflow-y-auto">
            <div id="pdf-viewer" class="w-full border-none"></div>
        </div>
    </div>

    <!-- Partie droite - Affichage du texte du PDF -->
    <div class="w-full md:w-1/5 md:pl-4 border-t-2 md:border-t-0 md:border-l-2 border-gray-300">
        <h2 class="text-lg font-semibold mb-2">Détails de l'annonce</h2>
        <div class="border rounded-lg p-4 shadow">
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $annonce->image_autorite_contractante) }}" alt="Logo" class="mx-auto h-36 object-cover" onerror="this.onerror=null;this.src='{{ asset('assets_3/logo.png') }}';">
            </div>
            <div class="text-center mb-4">
                <p class="text-blue-600 font-semibold">{{ $annonce->objet_marche }}</p>
                <button onclick="window.open('{{ asset('storage/' . $annonce->ficher_annonce) }}', '_blank')" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Télécharger le PDF</button>
            </div>
            <!-- Ajout des informations avec séparateurs -->
            <div class="text-left">
               
                <div class="mb-2">
                    <p class="text-sm font-medium">Nom Autorité Contractante</p>
                    <p class="text-lg font-semibold">{{ $annonce->nom_autorite_contractante }}</p>
                    <hr>
                    <p class="text-sm font-medium">Adresse Autorité Contractante </p>
                    <p class="text-lg font-semibold">{{ $annonce->adresse_autorite_contractante }}</p>

                    <hr>
                    <p class="text-sm font-medium">Lieu de Dépôt</p>
                    <p class="text-lg font-semibold">{{ $annonce->lieu_depot }}</p>
                    <hr>
                    <p class="text-sm font-medium">Garantie de Soumission </p>
                    <p class="text-lg font-semibold">{{ $annonce->garantie_soumission }}</p>


                    <hr>
                    <p class="text-sm font-medium">Source de Financement </p>
                    <p class="text-lg font-semibold">
                        
                        {{ $sourcefinance }}
                    
                    
                    </p>

                    <hr>
                    <p class="text-sm font-medium">Date limite</p>
                    <p class="text-lg font-semibold">{{ $annonce->date_cloture }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.worker.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var url = "{{ asset('storage/' . $annonce->ficher_annonce) }}";

    var pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.worker.min.js';

    var loadingTask = pdfjsLib.getDocument(url);
    loadingTask.promise.then(function (pdf) {
        console.log('PDF loaded');

        var container = document.getElementById('pdf-viewer');
        
        var renderPage = function(pageNumber) {
            pdf.getPage(pageNumber).then(function (page) {
                var scale = 1.5;
                var viewport = page.getViewport({ scale: scale });

                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                container.appendChild(canvas);

                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);
                renderTask.promise.then(function () {
                    console.log('Page rendered: ' + pageNumber);
                    if (pageNumber < pdf.numPages) {
                        renderPage(pageNumber + 1);
                    }
                });
            });
        };
        
        renderPage(1);
    }, function (reason) {
        console.error(reason);
    });
});
</script>

@endsection
