@extends('layouts.welcome')

@section('title')
    {{ __('Liste de toutes les annonces') }}
@endsection

@section('content')
    <main class="main">
        <!-- Page Title -->
        <div class="page-title" data-aos="fade" style="background-image: url('{{ asset('asset_7/assets/img/aff.jpg') }}');">
            <div class="container position-relative">
                <h1>Liste des annonces</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('welcome') }}">Accueil</a></li>
                        <li class="current">Annonces</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <section class="news section">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Annonces</h2>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Filtres</h5>
                                <!-- Filtres sous forme de tableau -->
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Nom Autorité Contractante</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="nom_autorite_contractante" id="nom_autorite_contractante"
                                                class="form-control" placeholder="Excemple UGP">
                                            </td>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Date de cloture</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="date" id="date_cloture" name="date_cloture" class="form-control" value="">

                                            </td>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Date de publication</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="date" id="date_pub" name="date_pub" class="form-control" value="">

                                            </td>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Date de publication</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="datePublication" id="date1semaine" value="1semaine">
                                                    <label class="form-check-label" for="date1semaine">
                                                        Il y a 1 semaine
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="datePublication" id="date2semaine" value="2semaine">
                                                    <label class="form-check-label" for="date2semaine">
                                                        Il y a 2 semaine
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="datePublication" id="date3semaine" value="3semaine">
                                                    <label class="form-check-label" for="date3semaine">
                                                        Il y a 3 semaine
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="datePublication"
                                                        id="date1mois" value="1mois">
                                                    <label class="form-check-label" for="date1mois">
                                                        Il y a 1 mois
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="datePublication"
                                                        id="date3mois" value="3mois">
                                                    <label class="form-check-label" for="date3mois">
                                                        Il y a 3 mois
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="datePublication"
                                                        id="date1ans" value="1ans">
                                                    <label class="form-check-label" for="date1ans">
                                                        Il y a 1 ans
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Type de Marché</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type_marche"
                                                        id="travaux" value="1">
                                                    <label class="form-check-label" for="travaux">
                                                        Marchés de Travaux
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type_marche"
                                                        id="fournitures" value="2">
                                                    <label class="form-check-label" for="fournitures">
                                                        Marchés de Fournitures
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type_marche"
                                                        id="services" value="3">
                                                    <label class="form-check-label" for="services">
                                                        Marchés de Services Courants
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type_marche"
                                                        id="prestations" value="4">
                                                    <label class="form-check-label" for="prestations">
                                                        Marchés de Prestations Intellectuelles
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Source de Financement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sourceFinancement"
                                                        id="fondPropreBIE" value="1">
                                                    <label class="form-check-label" for="fondPropreBIE">
                                                        Fond propre - BIE
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="sourceFinancement"
                                                    id="partenairePTF" value="2">
                                                <label class="form-check-label" for="partenairePTF">
                                                    Partenaire technique et financier - PTF
                                                </label>
                                            </div>
                                        </td>
                                        </tr>
                                        <!-- Sous-catégories pour Partenaire technique et financier - PTF -->
                                        <tr id="ptfSubCategories" style="display: none;">
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sousCategoriePTF"
                                                        id="banqueA" value="1">
                                                    <label class="form-check-label" for="banqueA">
                                                        Banque africaine de développement
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sousCategoriePTF"
                                                        id="fondMondial" value="2">
                                                    <label class="form-check-label" for="fondMondial">
                                                        Fond Mondial
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sousCategoriePTF"
                                                        id="banqueI" value="3">
                                                    <label class="form-check-label" for="banqueI">
                                                        Banque islamique de développement
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sousCategoriePTF"
                                                        id="giz" value="4">
                                                    <label class="form-check-label" for="giz">
                                                        GIZ
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sousCategoriePTF"
                                                        id="Afd" value="5">
                                                    <label class="form-check-label" for="Afd">
                                                        Agence française de développement
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label" for="autreSource">
                                                        Autre Source
                                                    </label>
                                                    <input type="text" name="autreSource" id="autreSource"
                                                        class="form-control" placeholder="Autre source">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                                <button id="resetFilters" class="btn btn-secondary mt-3">Effacer les critères de recherche</button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row" id="events-list">
                            @foreach ($events as $event)
                                <div class="col-xl-4 col-lg-6 col-md-6 mt-4">
                                    @php
                                        $dateCloture = \Carbon\Carbon::parse($event->date_cloture);
                                    @endphp

                                    @if ($dateCloture->isPast())
                                        <img src="{{ asset('asset_7/assets/img/class.png') }}"
                                            class="img-fluid mb-3 mb-lg-0 float-left" alt=""
                                            style="width: 100px; height: auto;">
                                    @else
                                        <img src="{{ asset('asset_7/assets/img/cours.png') }}"
                                            class="img-fluid mb-3 mb-lg-0 float-left" alt=""
                                            style="width: 100px; height: auto;">
                                    @endif
                                    <a href="{{ route('fonct.annonce', $event->event_id) }}">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $event->event_image) }}" alt="" class="card-img-top" style="height: 200px; object-fit: cover;" onerror="this.onerror=null;this.src='{{ asset('assets_3/logo.png') }}';">
                                            <div class="card-body text-center p-4">
                                                <h5 class="card-title">
                                                    <a href="{{ route('fonct.annonce', $event->event_id) }}"
                                                        class="link-primary"
                                                        data-id="{{ $event->event_id }}">{{ $event->event_title }}</a>
                                                </h5>
                                                <p class="card-text text-muted">
                                                    {{ Str::limit($event->event_address, 100) }}</p>
                                                <a href="{{ route('fonct.annonce', $event->event_id) }}"
                                                    class="btn btn-primary mt-4">Voir Détails</a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $events->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
       

       document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll(
        'input[name="sourceFinancement"], input[name="datePublication"], input[name="date_cloture"], input[name="autreSource"], input[name="nom_autorite_contractante"], input[name="sousCategoriePTF"], input[name="date_pub"], input[name="type_marche"]'
    );
    const ptfRadio = document.getElementById('partenairePTF');
    const ptfSubCategories = document.getElementById('ptfSubCategories');

    // Ajouter des écouteurs d'événements pour chaque filtre
    filters.forEach(filter => {
        filter.addEventListener('change', function() {
            // Afficher ou masquer les sous-catégories PTF
            if (ptfRadio.checked) {
                ptfSubCategories.style.display = 'table-row';
            } else {
                ptfSubCategories.style.display = 'none';
            }
            // Mettre à jour les events lorsque les filtres changent
            fetchEvents();
        });
    });

    // Écouteur pour le bouton de réinitialisation des filtres
    document.getElementById('resetFilters').addEventListener('click', function(event) {
        event.preventDefault(); // Empêcher le rechargement de la page

        // Réinitialiser les filtres
        filters.forEach(filter => {
            if (filter.type === 'radio' || filter.type === 'checkbox') {
                filter.checked = false;
            } else if (filter.type === 'text' || filter.type === 'date') { // Inclure les champs de date
                filter.value = '';
            }
        });

        // Masquer les sous-catégories
        ptfSubCategories.style.display = 'none';

        // Mettre à jour les events avec les filtres réinitialisés
        fetchEvents();
    });

    // Fonction pour récupérer les events filtrées
    function fetchEvents() {
        const sourceFinancement = document.querySelector('input[name="sourceFinancement"]:checked')?.value;
        const typeMarcher = document.querySelector('input[name="type_marche"]:checked')?.value;
        const categorieFinancement = document.querySelector('input[name="sousCategoriePTF"]:checked')?.value;
        const datePublication = document.querySelector('input[name="datePublication"]:checked')?.value;
        const autreSource = document.querySelector('input[name="autreSource"]')?.value;
        const nomAutorite = document.querySelector('input[name="nom_autorite_contractante"]')?.value;
        const dateCloture = document.querySelector('input[name="date_cloture"]')?.value;
        const datePub = document.querySelector('input[name="date_pub"]')?.value;

        // Récupérer les sous-catégories PTF sélectionnées
        const sousCategoriePTF = Array.from(document.querySelectorAll('input[name="sousCategoriePTF"]:checked')).map(el => el.value);

        // Affichage de typeMarcher pour débogage
        console.log(typeMarcher);

        // Construire l'URL de la requête avec les filtres
        let url = '{{ route('annonces.filter') }}';

        const params = new URLSearchParams();
        if (sourceFinancement) {
            params.append('sourceFinancement', sourceFinancement);
        }
        if (typeMarcher) {
            params.append('typeMarcher', typeMarcher);
        }
        if (categorieFinancement) {
            params.append('categorieFinancement', categorieFinancement);
        }
        if (datePublication) {
            params.append('datePublication', datePublication);
        }
        if (autreSource) {
            params.append('autreSource', autreSource);
        }
        if (dateCloture) {
            params.append('date_cloture', dateCloture);
        }
        if (datePub) {
            params.append('date_pub', datePub);
        }
        if (nomAutorite) {
            params.append('nom_autorite_contractante', nomAutorite);
        }
        if (sousCategoriePTF.length > 0) {
            params.append('sousCategoriePTF', sousCategoriePTF.join(','));
        }

        url = `${url}?${params.toString()}`;

        // Faire la requête pour obtenir les events filtrées
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    console.error('Network response was not ok:', response);
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                const eventsList = document.getElementById('events-list');
                eventsList.innerHTML = ''; // Vider la liste des events

                // Ajouter les events récupérées
                data.forEach(annonce => {
                    // Déterminer l'URL de l'image de l'autorité contractante
                    const imageUrl = annonce.image_autorite_contractante ? `{{ asset('storage/') }}/${annonce.image_autorite_contractante}` : '{{ asset('assets_3/logo.png') }}';

                    // Déterminer l'image de statut basée sur la date de clôture
                    const dateCloture = moment(annonce.date_cloture);
                    const isPast = dateCloture.isBefore(moment());
                    const statusImage = isPast ? '{{ asset('asset_7/assets/img/class.png') }}' : '{{ asset('asset_7/assets/img/cours.png') }}';

                    // Construire l'URL de l'annonce
                    const routeUrl = `{{ route('fonct.annonce', ':event_id') }}`.replace(':event_id', annonce.event_id);

                    // Créer les éléments HTML pour l'annonce
                    const annonceElement = document.createElement('div');
                    annonceElement.classList.add('col-xl-4', 'col-lg-6', 'col-md-6', 'mt-4');

                    const imgStatus = document.createElement('img');
                    imgStatus.src = statusImage;
                    imgStatus.classList.add('img-fluid', 'mb-3', 'mb-lg-0', 'float-left');
                    imgStatus.alt = '';
                    imgStatus.style.width = '100px';
                    imgStatus.style.height = 'auto';

                    const aElement = document.createElement('a');
                    aElement.href = routeUrl;

                    const cardDiv = document.createElement('div');
                    cardDiv.classList.add('card');

                    const imgAutorite = document.createElement('img');
                    imgAutorite.src = imageUrl;
                    imgAutorite.alt = '';
                    imgAutorite.classList.add('card-img-top');
                    imgAutorite.style.height = '200px';
                    imgAutorite.style.objectFit = 'cover';
                    imgAutorite.onerror = function() {
                        this.onerror = null;
                        this.src = '{{ asset('assets_3/logo.png') }}';
                    };

                    const cardBodyDiv = document.createElement('div');
                    cardBodyDiv.classList.add('card-body', 'text-center', 'p-4');

                    const cardTitle = document.createElement('h5');
                    cardTitle.classList.add('card-title');

                    const cardLink = document.createElement('a');
                    cardLink.href = routeUrl;
                    cardLink.classList.add('link-primary');
                    cardLink.dataset.event_id = annonce.event_id;
                    cardLink.textContent = annonce.objet_marche;

                    const cardText = document.createElement('p');
                    cardText.classList.add('card-text', 'text-muted');
                    cardText.textContent = annonce.description ? annonce.description.substring(0, 100) : '';

                    const btnDetails = document.createElement('a');
                    btnDetails.href = routeUrl;
                    btnDetails.classList.add('btn', 'btn-primary', 'mt-4');
                    btnDetails.textContent = 'Voir Détails';

                    // Assembler les éléments
                    cardTitle.appendChild(cardLink);
                    cardBodyDiv.appendChild(cardTitle);
                    cardBodyDiv.appendChild(cardText);
                    cardBodyDiv.appendChild(btnDetails);
                    cardDiv.appendChild(imgAutorite);
                    cardDiv.appendChild(cardBodyDiv);
                    aElement.appendChild(cardDiv);
                    annonceElement.appendChild(imgStatus);
                    annonceElement.appendChild(aElement);
                    eventsList.appendChild(annonceElement);
                });
            })
            .catch(error => {
                console.error('Error fetching events:', error);
                alert('Une erreur s\'est produite lors de la récupération des événements. Veuillez réessayer plus tard.');
            });
    }

    // Appeler fetchEvents au chargement initial pour afficher les annonces par défaut
    fetchEvents();
});

       

    </script>
@endsection
