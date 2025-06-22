<!-- Modal d'ajout -->
<div class="modal fade" id="add-Livraison-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une livraison</h4>
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
                        <form action="{{ route('livraisons.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">N° de commande</label>
                                    <input type="text" name="id_commande" class="form-control @error('id_commande') is-invalid @enderror" value="{{ old('id_commande') }}" required>
                                    @error('id_commande')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Date Commande</label>
                                    <input type="datetime-local" name="date_commande" class="form-control @error('date_commande') is-invalid @enderror" value="{{ old('date_commande') }}" required>
                                    @error('date_commande')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Date Livraison</label>
                                    <input type="datetime-local" name="date_livraison" class="form-control @error('date_livraison') is-invalid @enderror" value="{{ old('date_livraison') }}" required>
                                    @error('date_livraison')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Client</label>
                                    <select name="id_client" id="id_client" class="custom-select @error('id_client') is-invalid @enderror" required>
                                        <option value="">Sélectionner un client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id_client }}" data-nom="{{ $client->nom_client }}" {{ old('id_client') == $client->id_client ? 'selected' : '' }}>{{ $client->nom_client }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_client')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nom Client</label>
                                    <input type="text" name="nom_client" id="nom_client" class="form-control @error('nom_client') is-invalid @enderror" value="{{ old('nom_client') }}" required>
                                    @error('nom_client')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Adresse Livraison</label>
                                    <input type="text" name="adresse_livraison" class="form-control @error('adresse_livraison') is-invalid @enderror" value="{{ old('adresse_livraison') }}" required>
                                    @error('adresse_livraison')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Moyen de livraison</label>
                                    <select name="moyen_livraison" class="custom-select @error('moyen_livraison') is-invalid @enderror" required>
                                        <option value="Camion" {{ old('moyen_livraison') == 'Camion' ? 'selected' : '' }}>Camion</option>
                                        <option value="Moto" {{ old('moyen_livraison') == 'Moto' ? 'selected' : '' }}>Moto</option>
                                        <option value="Baché" {{ old('moyen_livraison') == 'Baché' ? 'selected' : '' }}>Baché</option>
                                        <option value="Gozem" {{ old('moyen_livraison') == 'Gozem' ? 'selected' : '' }}>Gozem</option>
                                    </select>
                                    @error('moyen_livraison')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Statut de livraison</label>
                                    <select name="statut_livraison" class="custom-select @error('statut_livraison') is-invalid @enderror" required>
                                        <option value="Livrée" {{ old('statut_livraison') == 'Livrée' ? 'selected' : '' }}>Livrée</option>
                                        <option value="Non Livrée" {{ old('statut_livraison') == 'Non Livrée' ? 'selected' : '' }}>Non Livrée</option>
                                        <option value="En Cours" {{ old('statut_livraison') == 'En Cours' ? 'selected' : '' }}>En Cours</option>
                                    </select>
                                    @error('statut_livraison')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Livreur</label>
                                    <select name="livreur_id" class="custom-select @error('livreur_id') is-invalid @enderror">
                                        <option value="">Aucun livreur</option>
                                        @foreach ($livreurs as $livreur)
                                            <option value="{{ $livreur->id }}" {{ old('livreur_id') == $livreur->id ? 'selected' : '' }}>{{ $livreur->nom_livreur }}</option>
                                        @endforeach
                                    </select>
                                    @error('livreur_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Délai Livraison</label>
                                    <input type="text" name="delai_livraison" class="form-control @error('delai_livraison') is-invalid @enderror" value="{{ old('delai_livraison') }}">
                                    @error('delai_livraison')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Commentaires</label>
                                    <textarea name="commentaires" class="form-control @error('commentaires') is-invalid @enderror">{{ old('commentaires') }}</textarea>
                                    @error('commentaires')
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

<!-- Modal de visualisation -->
@foreach ($livraisons as $livraison)
    <div class="modal fade" id="viewlivraisonModal-{{ $livraison->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Détails de la livraison</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body mb-5">
                    <div class="popup text-left">
                        <div class="content create-workform bg-body">
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nom Client</label>
                                    <input type="text" class="form-control" value="{{ $livraison->nom_client }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">N° de commande</label>
                                    <input type="text" class="form-control" value="{{ $livraison->id_commande }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Date Commande</label>
                                    <input type="text" class="form-control" value="{{ $livraison->date_commande->format('d/m/Y H:i') }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Date Livraison</label>
                                    <input type="text" class="form-control" value="{{ $livraison->date_livraison->format('d/m/Y H:i') }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Adresse Livraison</label>
                                    <input type="text" class="form-control" value="{{ $livraison->adresse_livraison }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Moyen de livraison</label>
                                    <input type="text" class="form-control" value="{{ $livraison->moyen_livraison }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Statut de livraison</label>
                                    <input type="text" class="form-control" value="{{ $livraison->statut_livraison }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Livré par</label>
                                    <input type="text" class="form-control" value="{{ $livraison->livreur ? $livraison->livreur->nom_livreur : '-' }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Délai Livraison</label>
                                    <input type="text" class="form-control" value="{{ $livraison->delai_livraison ?? '-' }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Commentaires</label>
                                    <textarea class="form-control" disabled>{{ $livraison->commentaires ?? '-' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'édition -->
    <div class="modal fade" id="editlivraisonModal-{{ $livraison->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier la livraison</h4>
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
                            <form action="{{ route('livraisons.update', $livraison->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">N° de commande</label>
                                        <input type="text" name="id_commande" class="form-control @error('id_commande') is-invalid @enderror" value="{{ old('id_commande', $livraison->id_commande) }}" required>
                                        @error('id_commande')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Date Commande</label>
                                        <input type="datetime-local" name="date_commande" class="form-control @error('date_commande') is-invalid @enderror" value="{{ old('date_commande', $livraison->date_commande->format('Y-m-d\TH:i')) }}" required>
                                        @error('date_commande')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Date Livraison</label>
                                        <input type="datetime-local" name="date_livraison" class="form-control @error('date_livraison') is-invalid @enderror" value="{{ old('date_livraison', $livraison->date_livraison->format('Y-m-d\TH:i')) }}" required>
                                        @error('date_livraison')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Client</label>
                                        <select name="id_client" id="id_client_edit-{{ $livraison->id }}" class="custom-select @error('id_client') is-invalid @enderror" required>
                                            <option value="">Sélectionner un client</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id_client }}" data-nom="{{ $client->nom_client }}" {{ old('id_client', $livraison->id_client) == $client->id_client ? 'selected' : '' }}>{{ $client->nom_client }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_client')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Nom Client</label>
                                        <input type="text" name="nom_client" id="nom_client_edit-{{ $livraison->id }}" class="form-control @error('nom_client') is-invalid @enderror" value="{{ old('nom_client', $livraison->nom_client) }}" required>
                                        @error('nom_client')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Adresse Livraison</label>
                                        <input type="text" name="adresse_livraison" class="form-control @error('adresse_livraison') is-invalid @enderror" value="{{ old('adresse_livraison', $livraison->adresse_livraison) }}" required>
                                        @error('adresse_livraison')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Moyen de livraison</label>
                                        <select name="moyen_livraison" class="custom-select @error('moyen_livraison') is-invalid @enderror" required>
                                            <option value="Camion" {{ old('moyen_livraison', $livraison->moyen_livraison) == 'Camion' ? 'selected' : '' }}>Camion</option>
                                            <option value="Moto" {{ old('moyen_livraison', $livraison->moyen_livraison) == 'Moto' ? 'selected' : '' }}>Moto</option>
                                            <option value="Baché" {{ old('moyen_livraison', $livraison->moyen_livraison) == 'Baché' ? 'selected' : '' }}>Baché</option>
                                            <option value="Gozem" {{ old('moyen_livraison', $livraison->moyen_livraison) == 'Gozem' ? 'selected' : '' }}>Gozem</option>
                                        </select>
                                        @error('moyen_livraison')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Statut de livraison</label>
                                        <select name="statut_livraison" class="custom-select @error('statut_livraison') is-invalid @enderror" required>
                                            <option value="Livrée" {{ old('statut_livraison', $livraison->statut_livraison) == 'Livrée' ? 'selected' : '' }}>Livrée</option>
                                            <option value="Non Livrée" {{ old('statut_livraison', $livraison->statut_livraison) == 'Non Livrée' ? 'selected' : '' }}>Non Livrée</option>
                                            <option value="En Cours" {{ old('statut_livraison', $livraison->statut_livraison) == 'En Cours' ? 'selected' : '' }}>En Cours</option>
                                        </select>
                                        @error('statut_livraison')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Livreur</label>
                                        <select name="livreur_id" class="custom-select @error('livreur_id') is-invalid @enderror">
                                            <option value="">Aucun livreur</option>
                                            @foreach ($livreurs as $livreur)
                                                <option value="{{ $livreur->id }}" {{ old('livreur_id', $livraison->livreur_id) == $livreur->id ? 'selected' : '' }}>{{ $livreur->nom_livreur }}</option>
                                            @endforeach
                                        </select>
                                        @error('livreur_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Délai Livraison</label>
                                        <input type="text" name="delai_livraison" class="form-control @error('delai_livraison') is-invalid @enderror" value="{{ old('delai_livraison', $livraison->delai_livraison) }}">
                                        @error('delai_livraison')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Commentaires</label>
                                        <textarea name="commentaires" class="form-control @error('commentaires') is-invalid @enderror">{{ old('commentaires', $livraison->commentaires) }}</textarea>
                                        @error('commentaires')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-center justify-content-center">
                                        <button type="button" class="btn btn-primary mr-4" data-dismiss="modal">Annuler</button>
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
@endforeach