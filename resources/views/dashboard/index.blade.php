<!doctype html>
<html lang="fr">

<head>
    <title>{{ $dashboard }}</title>
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
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4 card-total-sale">
                                            <div class="icon iq-icon-box-2 bg-info-light">
                                                <img src="../assets/images/product/1.png" class="img-fluid" alt="image">
                                            </div>
                                            <div>
                                                <p class="mb-2">Stock | Rupture</p>
                                                <h4> <span class='' data-toggle="modal" data-target="#stock-Modal" style="cursor: pointer;"> 402 </span> |
                                                    <span class="text-danger" data-toggle="modal"
                                                        data-target="#rupture-Modal" style="cursor: pointer;">
                                                        6
                                                    </span>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="iq-progress-bar mt-2">
                                            <span class="bg-info iq-progress progress-1" data-percent="85">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4" data-trigger="hover" data-toggle="popover"
                                data-placement="top" data-content="Chiffre d'affaire total ce mois en Fcfa">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4 card-total-sale">
                                            <div class="icon iq-icon-box-2 bg-info-light">
                                                <img src="../assets/images/product/1.png" class="img-fluid" alt="image">
                                            </div>
                                            <div>
                                                <p class="mb-2">Chiffre d'affaire</p>
                                                <h4>
                                                    <span data-toggle="modal" data-target="#ca-Modal" style="cursor: pointer;">
                                                        43 900f
                                                    </span>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="iq-progress-bar mt-2">
                                            <span class="bg-info iq-progress progress-1" data-percent="85">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('dashboard.modalDashboard')
                            <div class="col-lg-3 col-md-4" data-trigger="hover" data-toggle="popover"
                                data-placement="top" data-content="Délai moyen de livraison">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4 card-total-sale">
                                            <div class="icon iq-icon-box-2 bg-danger-light">
                                                <img src="../assets/images/product/2.png" class="img-fluid" alt="image">
                                            </div>
                                            <div>
                                                <p class="mb-2">Nbre de Livraisons</p>
                                                <h4>
                                                <span style="cursor: pointer;" data-toggle="modal" data-target="#livraison-Modal">
                                                     120
                                                </span>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="iq-progress-bar mt-2">
                                            <span class="bg-danger iq-progress progress-1" data-percent="70">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('dashboard.modalDashboard')
                            <div class="col-lg-3 col-md-4" data-trigger="hover" data-toggle="popover"
                                data-placement="top" data-content="Solde actuel en Fcfa">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4 card-total-sale">
                                            <div class="icon iq-icon-box-2 bg-success-light">
                                                <img src="../assets/images/product/3.png" class="img-fluid" alt="image">
                                            </div>
                                            <div>
                                                <p class="mb-2">Finances</p>
                                                <h5>
                                                    <span style="cursor: pointer;" data-toggle="modal" data-target="#finance-Modal">
                                                       5 400 000 f
                                                    </span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="iq-progress-bar mt-2">
                                            <span class="bg-success iq-progress progress-1" data-percent="75">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('dashboard.modalDashboard')
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
                                            This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right shadow-none"
                                            aria-labelledby="dropdownMenuButton001">
                                            <a class="dropdown-item" href="#">Year</a>
                                            <a class="dropdown-item" href="#">Month</a>
                                            <a class="dropdown-item" href="#">Week</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id produit</th>
                                            <th scope="col">Nom produit</th>
                                            <th scope="col">Quantite vendue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Jus Ananas</td>
                                            <td>145</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jus de raisin</td>
                                            <td>123</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Wisky</td>
                                            <td>110</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td>Jus de coco</td>
                                            <td>50</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5</th>
                                            <td>Jus simple</td>
                                            <td>30</td>
                                        </tr>
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
                                            <a class="dropdown-item" href="#">Yearly</a>
                                            <a class="dropdown-item" href="#">Monthly</a>
                                            <a class="dropdown-item" href="#">Weekly</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id client</th>
                                            <th scope="col">Nom client</th>
                                            <th scope="col">Quantite payer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>143</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>54</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>32</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td>Larry</td>
                                            <td>31</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5</th>
                                            <td>Larry</td>
                                            <td>10</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page end  -->
            </div>
        </div>

    </div>
    <!-- Wrapper End-->
    @include('dashboard.modalDashboard')
    @include('layouts.footer')
    @include('layouts.modal')

</body>

</html>