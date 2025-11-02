<!doctype html>
<html lang="fr">

<head>
    <title>Gestion des Ventes</title>
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
                        <<div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
    <div>
        <h2 class="mb-3">Gestion des ventes</h2>
        <p class="mb-0">Suivi complet des ventes : enregistrement rapide, historique détaillé, gestion des <br>
            commande pour une meilleure performance commerciale au quotidien.
            
        </p>
    </div>
    
    <div>
        <a href="{{ route('ventes.export') }}" class="btn btn-success add-list mr-2">
            <i class="las la-file-excel mr-3"></i>Exporter en Excel
        </a>
        <a href="#" class="btn btn-primary add-list" data-toggle="modal"
            data-target="#add-Vente-Modal">
            <i class="las la-plus mr-3"></i>Ajoutez une commande
        </a>
    </div>
</div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="table-responsive rounded mb-3">
                            <table class="data-tables table mb-0 tbl-server-info">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>N° de commande</th>
                                        <th>Date du commande</th>
                                        <th>Nom Produit</th>
                                        <th>Quantité Vendue</th>
                                        <th>Prix Unitaire</th>
                                        <th>Total Vente</th>
                                        <th>Mode de Paiement</th>
                                        <th>Commentaires</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ventes as $vente)
                                    <tr>
                                        <td>{{ $vente->id }}</td>
                                        <td>{{ $vente->date }}</td>
                                        <td>{{ $vente->nom_produit }}</td>
                                        <td>{{ $vente->quantite_vendue }}</td>
                                        <td>{{ $vente->prix_unitaire }}</td>
                                        <td>{{ $vente->total_vente }}</td>
                                        <td>{{ $vente->mode_paiement }}</td>
                                        <td>{{ $vente->commentaires }}</td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <a class="badge badge-info mr-2" data-toggle="modal" 
                                                    data-target="#viewVenteModal-{{ $vente->id }}" data-placement="top" 
                                                    title="" data-original-title="Voir" href="#"><i
                                                        class="ri-eye-line mr-0"></i></a>
                                                <a class="badge bg-success mr-2" data-toggle="modal"
                                                    data-target="#editVenteModal-{{ $vente->id }}" data-placement="top"
                                                    title="" data-original-title="Editer" href="#"><i
                                                        class="ri-pencil-line mr-0"></i></a>
                                                <form action="{{ route('ventes.destroy', $vente->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-warning mt-0 mr-2" style="border:none;" title="Supprimer" onclick="return confirm('Confirmer la suppression ?')"><i class="ri-delete-bin-line mr-0"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    @include('ventes.modalVente')
                                    @endforeach

                                    @include('ventes.modalVente', [
                                        'stocks' => $stocks,
                                        'clients' => $clients,
                                        'livreurs' => $livreurs,

                                    ])

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