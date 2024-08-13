<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Lien vers Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Titre de la page -->
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Dashboard</span>
        </li>
    </ul>
    <br>

    <div class="container mx-auto py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            <!-- Carte des contrats -->
            <div class="card card-animate overflow-hidden">
                <div class="relative" style="z-index: 0;">
                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                        <style>.s0 { opacity: .05; fill: var(--vz-success) }</style>
                        <path id="Shape 8" class="s0"
                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                    </svg>
                </div>
                <div class="card-body" style="z-index: 1;">
                    <div class="flex justify-between items-center">
                        <div class="flex-grow overflow-hidden">
                            <p class="text-uppercase font-medium text-gray-500 truncate">Nombre de Contrats</p>
                            <h4 class="text-2xl font-semibold text-secondary truncate">
                                <span class="counter-value" data-target="28410">{{ $suiviMarcheNbre }}</span>
                            </h4>
                        </div>
                        <div class="flex-shrink-0">
                            <div id="apply_jobs" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->

            <!-- Ajoutez les autres cartes ici -->

        </div><!-- end grid -->
    </div>

    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h3 class="bg-green-500 text-white px-4 py-2 rounded">
                {{ __('Analyse des Marchés Proches de la Date de Réception Anticipée 10 jours avant la date: :date', ['date' => $date]) }}
            </h3>
        </div>

        <div class="card-body">
            <table id="myTables" class="table-auto w-full mt-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2">{{ __('Intitulé') }}</th>
                        <th class="px-4 py-2">{{ __('Montant Prévisionnel') }}</th>
                        <th class="px-4 py-2">{{ __('Montant Attribution') }}</th>
                        <th class="px-4 py-2">{{ __('Titulaire') }}</th>
                        <th class="px-4 py-2">{{ __('Date d’approbation') }}</th>
                        <th class="px-4 py-2">{{ __('Date de l\'ordre de service') }}</th>
                        <th class="px-4 py-2">{{ __('Date probable de reception') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marches as $marche)
                        <tr>
                            <td class="border px-4 py-2">{{ $marche->libelle_marches }}</td>
                            <td class="border px-4 py-2">{{ $marche->montant_previsionnel }}</td>
                            <td class="border px-4 py-2">{{ $marche->montant_attribution }}</td>
                            <td class="border px-4 py-2">{{ $marche->titulaire }}</td>
                            <td class="border px-4 py-2">{{ $marche->date_approbation }}</td>
                            <td class="border px-4 py-2">{{ $marche->date_ordre_service }}</td>
                            <td class="border px-4 py-2">{{ $marche->date_probable_reception }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Charts -->
    <div class="container mx-auto py-6">
        <h4 class="mb-4">Statistiques des contrats</h4>
        <div id="chart" class="w-full h-96"></div>
    </div>
    
    <!-- Inclure ApexCharts.js -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Données
            var categories = ['Payé', 'Non Payé'];
            var paidContracts = {{ $paidContracts }};
            var unpaidContracts = {{ $unpaidContracts }};

            // Options du graphique
            var options = {
                chart: {
                    type: 'pie', // Changement du type de graphique à 'pie' (cercle)
                    height: 350,
                },
                series: [paidContracts, unpaidContracts],
                labels: ['Contrats Payés', 'Contrats Non Payés'],
                legend: {
                    position: 'top',
                },
            };

            // Créer le graphique
            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
</body>

</html>
