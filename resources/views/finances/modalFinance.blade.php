<!-- Modal d'ajout -->
<div class="modal fade" id="add-transaction-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une transaction</h4>
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
                        <form action="{{ route('finances.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Date</label>
                                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Type de transaction</label>
                                    <select name="type_transaction" class="custom-select @error('type_transaction') is-invalid @enderror" required>
                                        <option value="Dépôt" {{ old('type_transaction') == 'Dépôt' ? 'selected' : '' }}>Dépôt</option>
                                        <option value="Retrait" {{ old('type_transaction') == 'Retrait' ? 'selected' : '' }}>Retrait</option>
                                    </select>
                                    @error('type_transaction')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Catégorie</label>
                                    <select name="categorie" class="custom-select @error('categorie') is-invalid @enderror" required>
                                        <option value="Produits alimentaires" {{ old('categorie') == 'Produits alimentaires' ? 'selected' : '' }}>Produits alimentaires</option>
                                        <option value="Approvisionnement" {{ old('categorie') == 'Approvisionnement' ? 'selected' : '' }}>Approvisionnement</option>
                                        <option value="Autres" {{ old('categorie') == 'Autres' ? 'selected' : '' }}>Autres</option>
                                    </select>
                                    @error('categorie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Entrée/Sortie</label>
                                    <select name="entree_sortie" class="custom-select @error('entree_sortie') is-invalid @enderror" required>
                                        <option value="Entrée" {{ old('entree_sortie') == 'Entrée' ? 'selected' : '' }}>Entrée</option>
                                        <option value="Sortie" {{ old('entree_sortie') == 'Sortie' ? 'selected' : '' }}>Sortie</option>
                                    </select>
                                    @error('entree_sortie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Montant</label>
                                    <input type="number" name="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant') }}" required min="0" step="0.01">
                                    @error('montant')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
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