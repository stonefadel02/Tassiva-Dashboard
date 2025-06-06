<!doctype html>
<html lang="fr">

<head>
    <title>{{ $stocks }}</title>
    @include('layouts.meta')
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
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
                                <h2 class="mb-3">Gestion des Stocks</h2>
                                <p class="mb-0">La liste des produits dicte efficacement la présentation du produit et
                                    offre de l'espace.
                                    <br> pour répertorier vos produits et votre offre de la manière la plus attrayante.
                                </p>
                        </div>
                            <a href="#" class="btn border add-btn shadow-none mx-2 d-none d-md-block"
                                data-toggle="modal" data-target="#new-product"><i class="las la-plus mr-2"></i>Ajouter un produit</a>
                            <a href="#" class="btn btn-primary add-list" data-toggle="modal"
                                data-target="#add-Stock-Modal"><i class="las la-plus mr-3"></i>Ajoutez du stock</a>
                        </div>
                    </div>
                    @include('stocks.modalStock')
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
                                                    data-target="#viewStockModal-{{ $stock->id }}" data-placement="top" 
                                                    title="" data-original-title="Voir" href="#"><i
                                                        class="ri-eye-line mr-0"></i></a>
                                                <a class="badge bg-success mr-2" data-toggle="modal"
                                                    data-target="#editStockModal-{{ $stock->id }}" data-placement="top"
                                                    title="" data-original-title="Editer" href="#"><i
                                                        class="ri-pencil-line mr-0"></i></a>
                                                <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-warning mt-0 mr-2"
                                                        style="border:none;" data-toggle="tooltip" data-placement="top"
                                                        title="Cette action est irreversible"><i
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
                                            This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right shadow-none"
                                            aria-labelledby="dropdownMenuButton005">
                                            <a class="dropdown-item" href="#">Year</a>
                                            <a class="dropdown-item" href="#">Month</a>
                                            <a class="dropdown-item" href="#">Week</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body pt-0">
                                <div id="layout1-chart-5"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page end  -->
            </div>
        </div>

    </div>
    <!-- Wrapper End-->
    @include('layouts.footer')
    @include('layouts.modal')



    <script>
        if (jQuery("#layout1-chart-5").length) {    
            options = {
                series: [{
                    name: 'Stock Actuel',
                    data: {!! json_encode($stocks->pluck('stock_actuel')) !!}
                }, {
                    name: 'Stock Minimum',
                    data: {!! json_encode($stocks->pluck('stock_minimum')) !!}
                }],
                chart: {
                    type: 'bar',
                    height: 300
                },
                colors: ['#32BDEA', '#FF7E41'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '30%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 3,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: {!! json_encode($stocks->pluck('nom_produit')) !!},
                    labels: {
                        minWidth: 0,
                        maxWidth: 0
                    }
                },
                yaxis: {
                    show: true,
                    labels: {
                        minWidth: 20,
                        maxWidth: 20
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " unités";
                        }
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#layout1-chart-5"), options);
            chart.render();

            const body = document.querySelector('body');
            if (body.classList.contains('dark')) {
                apexChartUpdate(chart, { dark: true });
            }

            document.addEventListener('ChangeColorMode', function (e) {
                apexChartUpdate(chart, e.detail);
            });
        }
</script>


</body>

</html>