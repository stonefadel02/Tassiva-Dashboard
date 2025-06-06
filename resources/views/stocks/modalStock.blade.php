<!-- Ajouter du stock -->
<div class="modal fade" id="add-Stock-Modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('stocks.addModal') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nom du produit</label>
                                    <input type="text" name="nom_produit" class="form-control @error('nom_produit') is-invalid @enderror" value="{{ old('nom_produit') }}" required>
                                    @error('nom_produit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Réapprovisionnement</label>
                                    <input type="number" name="entrees" class="form-control @error('entrees') is-invalid @enderror" value="{{ old('entrees') }}" required>
                                    @error('entrees')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Seuil d'alerte</label>
                                    <input type="number" name="stock_minimum" class="form-control @error('stock_minimum') is-invalid @enderror" value="{{ old('stock_minimum') }}" required>
                                    @error('stock_minimum')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-center justify-content-center">
                                    <button type="button" class="btn btn-primary mr-4" data-dismiss="modal">Annuler</button>
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

<!-- Voir le stocks  -->
@if(isset($stocks) && $stocks->count() > 0)
    <div class="modal fade" id="viewStockModal-{{ $stock->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Information du stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-5">
                    <div class="popup text-left">
                        <div class="content create-workform bg-body">
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nom du produits</label>
                                    <input type="text" name="nom_produit" class="form-control" value="{{ $stock->nom_produit }}" disabled >
                                </div>
                                <div class="col">
                                    <label class="mb-2">Categories</label>
                                    <input type="text" name="entrees" class="form-control" value="" disabled >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Stocks initial</label>
                                    <input type="text" name="nom_produit" class="form-control" value="{{ $stock->stock_initial }}" disabled >
                                </div>
                                <div class="col">
                                    <label class="mb-2">Stocks actuel</label>
                                    <input type="text" name="entrees" class="form-control" value="{{ $stock->stock_actuel }}" disabled >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Derniere entré</label>
                                    <input type="text" name="nom_produit" class="form-control" value="{{ $stock->entrees }}" disabled >
                                </div>
                                <div class="col">
                                    <label class="mb-2">Nombre vendu</label>
                                    <input type="text" name="entrees" class="form-control" value="{{ $stock->sorties }}" disabled >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Stocks minimum</label>
                                    <input type="text" name="nom_produit" class="form-control" value="{{ $stock->stock_minimum }}" disabled >
                                </div>
                                <div class="col">
                                    <label class="mb-2">Rupture</label>
                                    <input type="text" name="entrees" class="form-control" value="{{ $stock->rupture ? 'OUI' : 'NON' }}" disabled >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Derniere MAJ</label>
                                    <input type="text" name="stock_minimum" class="form-control" value="25/12/2025" disabled >
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
                                        <!-- <input type="text" name="nom_produit" class="form-control" value="{{ $stock->nom_produit }}" required> -->
                                        <select class="custom-select">
                                            <option selected>Jus d'ananas</option>
                                            <option value="1">Jus d'ananas</option>
                                            <option value="2">Jus de raisin</option>
                                            <option value="3">Poulet</option>
                                        </select>

                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Réapprovisionnement</label>
                                        <input type="number" name="entrees" class="form-control" value="{{ $stock->entrees }}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Seuil d'alerte</label>
                                        <input type="number" name="stock_minimum" class="form-control" value="{{ $stock->stock_minimum }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <div class="btn btn-primary mr-4" data-dismiss="modal">Annuler</div>
                                        <div type="submit" class="btn btn-outline-primary" data-dismiss="modal">Mettre à jour</div>
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