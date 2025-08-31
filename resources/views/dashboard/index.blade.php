<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $dashboard }}</title>
    @include('layouts.meta')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Loader Start -->
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <!-- Loader END -->

    <!-- Wrapper Start -->
    <div class="wrapper">
        @include('layouts.sidebar')
        @include('layouts.navbar')

        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4 card-total-sale">
                                            <div class="icon iq-icon-box-2 bg-info-light">
                                                <img src="../assets/images/product/shop.png" class="img-fluid"
                                                    alt="image">
                                            </div>
                                            <div>
                                                <p class="mb-2">Stock | Rupture</p>
                                                <h4>
                                                    <span data-toggle="modal" data-target="#stock-Modal"
                                                        style="cursor: pointer;">
                                                        {{ $totalProduitsEnStock }}
                                                    </span> |
                                                    <span class="text-danger" data-toggle="modal"
                                                        data-target="#rupture-Modal" style="cursor: pointer;">
                                                        {{ $produitsEnRupture }}
                                                    </span>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="iq-progress-bar mt-2">
                                            <span class="bg-info iq-progress progress-1"
                                                data-percent="{{ $totalProduitsEnStock > 0 ? (1 - $produitsEnRupture / $totalProduitsEnStock) * 100 : 0 }}">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4" data-trigger="hover" data-toggle="popover"
                                data-placement="top" data-content="Chiffre d'affaires total cette semaine en FCFA">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4 card-total-sale">
                                            <div class="icon iq-icon-box-2 bgrose">
                                                <img src="../assets/images/product/chart.png" class="img-fluid"
                                                    alt="image">
                                            </div>
                                            <div>
                                                <p class="mb-2">Chiffre d'affaires</p>
                                                <h4>
                                                    <span data-toggle="modal" data-target="#ca-Modal"
                                                        style="cursor: pointer;">
                                                        {{ number_format($chiffreAffaireSemaine, 0) }} FCFA
                                                    </span>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="iq-progress-bar mt-2">
                                            <span class="bgrose iq-progress progress-1" data-percent="85">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4" data-trigger="hover" data-toggle="popover"
                                data-placement="top" data-content="Nombre de livraisons aujourd'hui">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4 card-total-sale">
                                            <div class="icon iq-icon-box-2 bgblue">
                                                <img src="../assets/images/product/livraison.png" class="img-fluid"
                                                    alt="image">
                                            </div>
                                            <div>
                                                <p class="mb-2">Nbre de Livraisons</p>
                                                <h4>
                                                    <span style="cursor: pointer;" data-toggle="modal"
                                                        data-target="#livraison-Modal">
                                                        {{ $livraisonsParJour }}
                                                    </span>
                                                </h4>
                                                <small class="text-danger d-block">En retard :
                                                    {{ $livraisonsEnRetard->count() }}</small>
                                                <small class="text-warning d-block">Dans 1h :
                                                    {{ $livraisonsDansUneHeure->count() }}</small>

                                            </div>
                                        </div>
                                        <div class="iq-progress-bar mt-2">
                                            <span class="bgblue iq-progress progress-1" data-percent="70">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4" data-trigger="hover" data-toggle="popover"
                                data-placement="top" data-content="Solde actuel de l'entreprise en FCFA">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4 card-total-sale">
                                            <div class="icon iq-icon-box-2 bg-success-light">
                                                <img src="../assets/images/product/money.png" class="img-fluid"
                                                    alt="image">
                                            </div>
                                            <div>
                                                <p class="mb-2">Solde Actuel</p>
                                                <h5>
                                                    <span style="cursor: pointer;" data-toggle="modal"
                                                        data-target="#finance-Modal">
                                                        {{ number_format($soldeActuel, 0) }} FCFA
                                                    </span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="iq-progress-bar mt-2">
                                            <span class="bg-success iq-progress progress-1"
                                                data-percent="{{ $totalRecettes > 0 ? ($soldeActuel / ($soldeInitial + $totalRecettes)) * 100 : 0 }}">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Top produits</h4>
                                </div>
                                <div class="card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton001"
                                            data-toggle="dropdown">
                                            Ce mois<i class="ri-arrow-down-s-line ml-1"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right shadow-none"
                                            aria-labelledby="dropdownMenuButton001">
                                            <a class="dropdown-item" href="#">Année</a>
                                            <a class="dropdown-item" href="#">Mois</a>
                                            <a class="dropdown-item" href="#">Semaine</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID produit</th>
                                            <th scope="col">Nom produit</th>
                                            <th scope="col">Quantité vendue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topProduits as $produit)
                                            <tr>
                                                <th scope="row">{{ $produit->produit_id }}</th>
                                                <td>{{ $produit->nom_produit }}</td>
                                                <td>{{ $produit->total_quantite }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Top clients</h4>
                                </div>
                                <div class="card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton002"
                                            data-toggle="dropdown">
                                            Ce mois<i class="ri-arrow-down-s-line ml-1"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right shadow-none"
                                            aria-labelledby="dropdownMenuButton002">
                                            <a class="dropdown-item" href="#">Année</a>
                                            <a class="dropdown-item" href="#">Mois</a>
                                            <a class="dropdown-item" href="#">Semaine</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID client</th>
                                            <th scope="col">Nom client</th>
                                            <th scope="col">Montant payé (FCFA)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topClients as $client)
                                            <tr>
                                                <th scope="row">{{ $client->id_client }}</th>
                                                <td>{{ $client->nom_client }}</td>
                                                <td>{{ number_format($client->total_achats, 0) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Graphique des finances -->
                    <div class="col-lg-12">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-header">
                                <h4 class="card-title">Finances (3 derniers mois)</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="financeChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper End -->

    @include('dashboard.modalDashboard')
    @include('layouts.footer')
    @include('layouts.modal')

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const ctx = document.getElementById('financeChart').getContext('2d');
        const revenus = @json($revenus);
        const depenses = @json($depenses);
        const labels = ['{{ Carbon\Carbon::now()->subMonths(2)->translatedFormat('F') }}',
            '{{ Carbon\Carbon::now()->subMonths(1)->translatedFormat('F') }}',
            '{{ Carbon\Carbon::now()->translatedFormat('F') }}'
        ];

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Recettes',
                        data: [revenus[{{ Carbon\Carbon::now()->subMonths(2)->month }}] || 0, revenus[
                            {{ Carbon\Carbon::now()->subMonths(1)->month }}] || 0, revenus[
                            {{ Carbon\Carbon::now()->month }}] || 0],
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Dépenses',
                        data: [depenses[{{ Carbon\Carbon::now()->subMonths(2)->month }}] || 0, depenses[
                            {{ Carbon\Carbon::now()->subMonths(1)->month }}] || 0, depenses[
                            {{ Carbon\Carbon::now()->month }}] || 0],
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
