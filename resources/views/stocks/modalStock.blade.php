<!-- Modal Voir le stock -->
@if(isset($stocks) && $stocks->count() > 0)
    <div class="modal fade" id="viewStockModal-{{ $stock->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Information du stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body mb-5">
                    <div class="popup text-left">
                        <div class="content create-workform bg-body">
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nom du produit</label>
                                    <input type="text" class="form-control" value="{{ $stock->nom_produit }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Stock initial</label>
                                    <input type="text" class="form-control" value="{{ $stock->stock_initial }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Stock actuel</label>
                                    <input type="text" class="form-control" value="{{ $stock->stock_actuel }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Dernière entrée</label>
                                    <input type="text" class="form-control" value="{{ $stock->entrees }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nombre vendu</label>
                                    <input type="text" class="form-control" value="{{ $stock->sorties }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Stock minimum</label>
                                    <input type="text" class="form-control" value="{{ $stock->stock_minimum }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Rupture</label>
                                    <input type="text" class="form-control" value="{{ $stock->rupture ? 'OUI' : 'NON' }}"
                                        disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Dernière MAJ</label>
                                    <input type="text" class="form-control"
                                        value="{{ $stock->updated_at->format('d/m/Y') }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
<p></p>
@endif





<!-- Editer le stocks  -->
@if(isset($stocks) && $stocks->count() > 0)
    <div class="modal fade" id="editStockModal-{{ $stock->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier le stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="popup text-left">
                        <div class="content create-workform bg-body">
                            <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Nom du produits</label>
                                        <input type="text" name="nom_produit" class="form-control"
                                            value="{{ $stock->nom_produit }}" required>
                                        <!-- <select class="custom-select">
                                            <option selected>Jus d'ananas</option>
                                            <option value="1">Jus d'ananas</option>
                                            <option value="2">Jus de raisin</option>
                                            <option value="3">Poulet</option>
                                        </select> -->

                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Réapprovisionnement</label>
                                        <input type="number" name="entrees" class="form-control"
                                            value="{{ $stock->entrees }}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Seuil d'alerte</label>
                                        <input type="number" name="stock_minimum" class="form-control"
                                            value="{{ $stock->stock_minimum }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <button type="button" class="btn btn-primary mr-4"
                                            data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-outline-primary">Mettre à jour</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
<p></p>
@endif



<!-- Modal de réapprovisionnement -->
<div class="modal fade" id="reapproModal-{{ $stock->id }}" tabindex="-1" role="dialog"
    aria-labelledby="reapproLabel-{{ $stock->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('stocks.reapprovisionner', $stock->id) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="reapproLabel-{{ $stock->id }}">Réapprovisionner {{ $stock->nom_produit
                        }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="entrees">Quantité à ajouter</label>
                    <input type="number" name="entrees" class="form-control" min="0" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter au stock</button>
                </div>
            </form>
        </div>
    </div>
</div>