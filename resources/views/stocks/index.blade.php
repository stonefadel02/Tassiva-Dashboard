<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Gestion des Stocks</title>
    @include('layouts.meta')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        @include('layouts.sidebar')
        @include('layouts.navbar')

        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                            <div>
                                <h2 class="mb-3">Gestion des stocks</h2>
                                <p class="mb-0">La liste des produits dicte efficacement la présentation du produit et
                                    offre de l'espace.
                                    <br> pour répertorier vos produits et votre offre de la manière la plus attrayante.
                                </p>
                            </div>
                            <a href="#" class="btn btn-primary add-list" data-toggle="modal"
                                data-target="#addStockModal"><i class="las la-plus mr-3"></i>Ajoutez du stock</a>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="table-responsive rounded mb-3">
                            <table class="data-tables table mb-0 tbl-server-info">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>ID</th>
                                        <th>Nom du produit</th>
                                        <th>Stock Initial</th>
                                        <th>Entrées</th>
                                        <th>Sorties</th>
                                        <th>Stock Actuel</th>
                                        <th>Stock Minimum</th>
                                        <th>Rupture ?</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stocks as $stock)
                                    <tr>
                                        <td>{{ $stock->id }}</td>
                                        <td>{{ $stock->nom_produit }}</td>
                                        <td>{{ $stock->stock_initial }}</td>
                                        <td>{{ $stock->entrees }}</td>
                                        <td>{{ $stock->sorties }}</td>
                                        <td>{{ $stock->stock_actuel }}</td>
                                        <td>{{ $stock->stock_minimum }}</td>
                                        <td class="{{ $stock->rupture ? 'text-danger font-weight-bold' : '' }}">
                                            {{ $stock->rupture ? 'OUI' : 'NON' }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <a class="badge badge-info mr-2" data-toggle="modal"
                                                    data-target="#viewStockModal-{{ $stock->id }}" title="Voir"
                                                    href="#"><i class="ri-eye-line mr-0"></i></a>
                                                <a class="badge bg-success mr-2" data-toggle="modal"
                                                    data-target="#editStockModal-{{ $stock->id }}" title="Editer"
                                                    href="#"><i class="ri-pencil-line mr-0"></i></a>
                                                <a class="badge bg-success mr-2" data-toggle="modal"
                                                    data-target="#reapproModal-{{ $stock->id }}" title="Editer"
                                                    href="#"><i class="ri-refresh-line"></i></a>
                                                <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-warning mt-0 mr-2"
                                                        style="border:none;" data-toggle="tooltip" data-placement="top"
                                                        title="Cette action est irréversible"><i
                                                            class="ri-delete-bin-line mr-0"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('stocks.modalStock')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Graphique des Stocks</h4>
                                </div>
                                <div class="card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton005"
                                            data-toggle="dropdown">
                                            Ce mois<i class="ri-arrow-down-s-line ml-1"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right shadow-none"
                                            aria-labelledby="dropdownMenuButton005">
                                            <a class="dropdown-item" href="#">Année</a>
                                            <a class="dropdown-item" href="#">Mois</a>
                                            <a class="dropdown-item" href="#">Semaine</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <canvas id="stockChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page end -->
            </div>
        </div>
    </div>
    <!-- Wrapper End-->

    @include('layouts.footer')
    @include('layouts.modal')


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('stockChart').getContext('2d');
        const stockChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($stocks-> pluck('nom_produit'))!!},
        datasets: [{
            label: 'Stock Actuel',
            data: {!! json_encode($stocks-> pluck('stock_actuel')) !!},
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
                }, {
            label: 'Stock Minimum',
            data: {!! json_encode($stocks-> pluck('stock_minimum')) !!},
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
                }]
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

<!-- Ajouter du stock -->
<div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter du stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="popup text-left">
                    <div class="content create-workform bg-body">
                        
                        <form action="{{ route('stocks.addModal') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nom du produit</label>
                                    <input type="text" name="nom_produit"
                                        class="form-control @error('nom_produit') is-invalid @enderror"
                                        value="{{ old('nom_produit') }}" required>
                                    @error('nom_produit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Approvisionnement</label>
                                    <input type="number" name="entrees"
                                        class="form-control @error('entrees') is-invalid @enderror"
                                        value="{{ old('entrees') }}" required>
                                    @error('entrees')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Seuil d'alerte</label>
                                    <input type="number" name="stock_minimum"
                                        class="form-control @error('stock_minimum') is-invalid @enderror"
                                        value="{{ old('stock_minimum') }}" required>
                                    @error('stock_minimum')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-center justify-content-center">
                                    <button type="button" class="btn btn-primary mr-4"
                                        data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-outline-primary">Ajouter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</html>