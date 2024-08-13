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
                        <div class="row" id="annonces-list">
                            @foreach ($annonces as $annonce)
                                <div class="col-xl-4 col-lg-6 col-md-6 mt-4">
                                    @php
                                        $dateCloture = \Carbon\Carbon::parse($annonce->date_cloture);
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
                                    <a href="{{ route('fonct.annonce', $annonce->id) }}">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $annonce->image_autorite_contractante) }}"
                                                alt="" class="card-img-top"
                                                style="height: 200px; object-fit: cover;"
                                                file:///home/isidoredev/Documents/Projet%20Sirius%20Digital/marcher_Public/Gestion%20Marcher_public_sirius/Portail-Togolais-Marche-Publics/code_marcher/resources/views/annonces/create.blade.php
                                                onerror="this.onerror=null;this.src='{{ asset('assets_3/logo.png') }}';">
                                            <div class="card-body text-center p-4">
                                                <h5 class="card-title">
                                                    <a href="{{ route('fonct.annonce', $annonce->id) }}"
                                                        class="link-primary"
                                                        data-id="{{ $annonce->id }}">{{ $annonce->objet_marche }}</a>
                                                </h5>
                                                <p class="card-text text-muted">
                                                    {{ Str::limit($annonce->description, 100) }}</p>
                                                <a href="{{ route('fonct.annonce', $annonce->id) }}"
                                                    class="btn btn-primary mt-4">Voir Détails</a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $annonces->links('vendor.pagination.bootstrap-4') }}
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
                'input[name="sourceFinancement"], input[name="datePublication"], input[name="date_cloture"], input[name="autreSource"], input[name="nom_autorite_contractante"], input[name="sousCategoriePTF"]'
                );
            const ptfRadio = document.getElementById('partenairePTF');
            const ptfSubCategories = document.getElementById('ptfSubCategories');

            filters.forEach(filter => {
                filter.addEventListener('change', function() {
                    // Afficher ou masquer les sous-catégories PTF
                    if (ptfRadio.checked) {
                        ptfSubCategories.style.display = 'table-row';
                    } else {
                        ptfSubCategories.style.display = 'none';
                    }
                    fetchAnnonces();
                });
            });

            document.getElementById('resetFilters').addEventListener('click', function() {
                // Réinitialiser les filtres
                filters.forEach(filter => {
                    if (filter.type === 'radio' || filter.type === 'checkbox') {
                        filter.checked = false;
                    } else if (filter.type === 'text') {
                        filter.value = '';
                    }
                });
                // Masquer les sous-catégories
                ptfSubCategories.style.display = 'none';
                // Réactualiser la page
                window.location.reload();
            });

            function fetchAnnonces() {
                const sourceFinancement = document.querySelector('input[name="sourceFinancement"]:checked')?.value;
                const categorieFinancement = document.querySelector('input[name="sousCategoriePTF"]:checked')
                ?.value;
                const datePublication = document.querySelector('input[name="datePublication"]:checked')?.value;
                const autreSource = document.querySelector('input[name="autreSource"]')?.value;
                const nomAutorite = document.querySelector('input[name="nom_autorite_contractante"]')?.value;

                const dateCloture = document.querySelector('input[name="date_cloture"]')?.value;
                //

                const sousCategoriePTF = Array.from(document.querySelectorAll(
                    'input[name="sousCategoriePTF"]:checked')).map(el => el.value);
                //affichage de date cloti
                console.log(dateCloture);
                let url = '{{ route('annonces.filter') }}';

                const params = new URLSearchParams();
                if (sourceFinancement) {
                    params.append('sourceFinancement', sourceFinancement);
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
                if (nomAutorite) {
                    params.append('nom_autorite_contractante', nomAutorite);
                }
                if (sousCategoriePTF.length > 0) {
                    params.append('sousCategoriePTF', sousCategoriePTF.join(','));
                }

                url = `${url}?${params.toString()}`;

                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            console.error('Network response was not ok:', response);
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        const annoncesList = document.getElementById('annonces-list');
                        annoncesList.innerHTML = '';
                        data.forEach(annonce => {
                            const imageUrl = annonce.image_autorite_contractante ?
                                `{{ asset('storage/') }}/${annonce.image_autorite_contractante}` :
                                '{{ asset('assets_3/logo.png') }}';
                            const dateCloture = moment(annonce.date_cloture);
                            const isPast = dateCloture.isBefore(moment());
                            const statusImage = isPast ?
                                '{{ asset('asset_7/assets/img/class.png') }}' :
                                '{{ asset('asset_7/assets/img/cours.png') }}';
                            const routeUrl = `{{ route('fonct.annonce', ':id') }}`.replace(':id',
                                annonce.id);

                            annoncesList.innerHTML += `
                        <div class="col-xl-4 col-lg-6 col-md-6 mt-4">
                            <img src="${statusImage}" class="img-fluid mb-3 mb-lg-0 float-left" alt="" style="width: 100px; height: auto;">
                            <a href="${routeUrl}">
                                <div class="card">
                                    <img src="${imageUrl}" alt="" class="card-img-top" style="height: 200px; object-fit: cover;">
                                    <div class="card-body text-center p-4">
                                        <h5 class="card-title">
                                            <a href="${routeUrl}" class="link-primary" data-id="${annonce.id}">${annonce.objet_marche}</a>
                                        </h5>
                                        <p class="card-text text-muted">${annonce.description ? annonce.description.substring(0, 100) : ''}</p>
                                        <a href="${routeUrl}" class="btn btn-primary mt-4">Voir Détails</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    `;
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching annonces:', error);
                        alert('An error occurred while fetching annonces. Please try again later.');
                    });
            }
        });
    </script>
@endsection
