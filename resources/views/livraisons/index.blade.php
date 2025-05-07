<!doctype html>
<html lang="fr">

@php
    use Carbon\Carbon;
@endphp

<head>
    <title>{{ $livraisons }}</title>
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
                                <h2 class="mb-3">Gestion des livraisons</h2>
                                <p class="mb-0">Organisation efficace des livraisons : assignation des livreurs, suivi en temps réel, <br>
                                    historique complet et statut de chaque commande pour une distribution sans faille.
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="table-responsive rounded mb-3">
                            <table class="data-tables table mb-0 tbl-server-info">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>N° de commande</th>
                                        <th>Date Commande</th>
                                        <th>Date Livraison</th>
                                        <th>Nom Client</th>
                                        <th>Adresse Livraison</th>
                                        <th>Moyen Livraison</th>
                                        <th>Statut Livraison</th>
                                        <th>Délai Livraison</th>
                                        <th>Commentaires</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($livraisons as $livraison)
                                    <tr>
                                        <td>{{ $livraison->id_commande }}</td>
                                        <td>{{ $livraison->date_commande }}</td>
                                        <td class="{{ \Carbon\Carbon::parse($livraison->date_livraison)->isPast() ? 'text-danger font-weight-bold' : '' }}">
                                            {{ $livraison->date_livraison }}
                                        </td>
                                        <td>{{ $livraison->nom_client }}</td>
                                        <td>{{ $livraison->adresse_livraison }}</td>
                                        <td>{{ $livraison->moyen_livraison }}</td>
                                        <td>{{ $livraison->statut_livraison }}</td>
                                        <td>{{ $livraison->delai_livraison }}</td>
                                        <td>{{ $livraison->commentaires }}</td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <a class="badge badge-info mr-2" data-toggle="modal" 
                                                    data-target="#viewlivraisonModal-{{ $livraison->id }}" data-placement="top" 
                                                    title="" data-original-title="Voir" href="#"><i
                                                        class="ri-eye-line mr-0"></i></a>
                                                <a class="badge bg-success mr-2" data-toggle="modal"
                                                    data-target="#editlivraisonModal-{{ $livraison->id }}" data-placement="top"
                                                    title="" data-original-title="Editer" href="#"><i
                                                        class="ri-pencil-line mr-0"></i></a>
                                                <form action="{{ route('stocks.destroy', $livraison->id) }}" method="POST"
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
                                    @include('livraisons.modalLivraison')
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