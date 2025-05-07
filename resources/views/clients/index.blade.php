<!doctype html>
<html lang="fr">

<head>
    <title>{{ $clients }}</title>
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
                                <h2 class="mb-3">Gestion des Clients</h2>
                                <p class="mb-0">La liste des produits dicte efficacement la présentation du produit et
                                    offre de l'espace.
                                    <br> pour répertorier vos produits et votre offre de la manière la plus attrayante.
                                </p>
                            </div>
                            <a href="#" class="btn btn-primary add-list" data-toggle="modal"
                                data-target="#add-Client-Modal"><i class="las la-plus mr-3"></i>Ajoutez un Clients</a>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="table-responsive rounded mb-3">
                            <table class="data-tables table mb-0 tbl-server-info">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>ID Client</th>
                                        <th>Nom du Client</th>
                                        <th>Telephone</th>
                                        <th>Adresse</th>
                                        <th>Date d'ajout</th>

                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    @include('clients.modalClients')
                                </tbody>

                            </table>
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



</body>

</html>