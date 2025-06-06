<!-- Modal pour rupture -->
<div class="modal fade" id="rupture-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Produits en rupture</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID produit</th>
                            <th scope="col">Nom produit</th>
                            <th scope="col">Stock actuel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocksEnRupture as $stock)
                            <tr>
                                <th scope="row">{{ $stock->id }}</th>
                                <td>{{ $stock->nom_produit }}</td>
                                <td>{{ $stock->stock_initial + $stock->entrees - $stock->sorties }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour stock -->
<div class="modal fade" id="stock-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Produits en stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID produit</th>
                            <th scope="col">Nom produit</th>
                            <th scope="col">Stock actuel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Models\Stock::all() as $stock)
                            <tr>
                                <th scope="row">{{ $stock->id }}</th>
                                <td>{{ $stock->nom_produit }}</td>
                                <td>{{ $stock->stock_initial + $stock->entrees - $stock->sorties }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Chiffre d'affaires -->
<div class="modal fade" id="ca-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Détail du chiffre d'affaires</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mois</th>
                            <th>Chiffre d'affaires (FCFA)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chiffreAffaireParMois as $ca)
                            <tr>
                                <td>{{ \Carbon\Carbon::create($ca->year, $ca->month)->translatedFormat('F Y') }}</td>
                                <td>{{ number_format($ca->total, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ... Autres modaux inchangés ... -->

<!-- Modal Nombre de Livraison -->
<div class="modal fade" id="livraison-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Détail des Livraisons</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Commande</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dernieresLivraisons as $livraison)
                            <tr>
                                <td>{{ $livraison->date_livraison ? $livraison->date_livraison->format('d/m/Y') : 'N/A' }}</td>
                                <td>{{ $livraison->nom_client ?: 'N/A' }}</td>
                                <td>{{ $livraison->id_commande }}</td>
                                <td>{{ $livraison->statut_livraison }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ... Autres modaux inchangés ... -->

<!-- Modal Finance -->
<div class="modal fade" id="finance-Modal" tabindex="-1" role="dialog" aria-labelledby="financeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="financeModalLabel">Résumé Finance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Montant (FCFA)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Recettes</td>
                            <td>{{ number_format($totalRecettes, 0) }}</td>
                        </tr>
                        <tr>
                            <td>Dépenses</td>
                            <td>{{ number_format($totalDepenses, 0) }}</td>
                        </tr>
                        <tr>
                            <td>Bénéfice</td>
                            <td>{{ number_format($benefices, 0) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>