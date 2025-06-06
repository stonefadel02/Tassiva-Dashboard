<!doctype html>
<html lang="fr">

<head>
    <title>{{ $finances }}</title>
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
                                <h2 class="mb-3">Gestion des Finances</h2>
                                <p class="mb-0">La liste des produits dicte efficacement la présentation du produit et
                                    offre de l'espace.
                                    <br> pour répertorier vos produits et votre offre de la manière la plus attrayante.
                                </p>
                            </div>
                            <a href="#" class="btn btn-primary add-list" data-toggle="modal"
                                data-target="#add-trasaction-Modal"><i class="las la-plus mr-3"></i>Faire une transaction</a>
                        </div>
                         @include('finances.modalFinance')
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="table-responsive rounded mb-3">
                            <table class="data-tables table mb-0 tbl-server-info">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>Date de transaction</th>
                                        <th>Type de transaction</th>
                                        <th>Catégorie</th>
                                        <th>Description</th>
                                        <th>Montant</th>
                                        <th>Entrée/Sortie</th>
                                        <th>Solde</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($finances as $finance)
                                    <tr>
                                        <td>{{ $finance->date }}</td>
                                        <td>{{ $finance->type_transaction }}</td>
                                        <td>{{ $finance->categorie }}</td>
                                        <td>{{ $finance->description }}</td>
                                        <td>{{ $finance->montant }}</td>
                                        <td class="{{ $finance->entree_sortie ? 'text-succes font-weight-bold' : 'text-danger font-weight-bold' }}">
                                            {{ $finance->entree_sortie ? 'Entrée' : 'Sortie' }}
                                        </td>
                                        <td>{{ $finance->solde }}</td>
                                    </tr>
                                    @include('finances.modalFinance')
                                    @endforeach
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