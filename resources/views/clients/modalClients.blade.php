@if(isset($clients) && $clients->count() > 0)
<div class="modal fade" id="edit-Client-Modal-{{ $client->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifier un client</h4>
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
                        <form action="{{ route('clients.update', $client->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">ID Client</label>
                                    <input type="text" name="id_client" class="form-control @error('id_client') is-invalid @enderror" value="{{ $client->id }}" required>
                                    @error('id_client')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Nom du Client</label>
                                    <input type="text" name="nom_client" class="form-control @error('nom_client') is-invalid @enderror" value="{{ $client->nom_client }}" required>
                                    @error('nom_client')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Téléphone</label>
                                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ $client->telephone }}">
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Catégorie</label>
                                    <select name="categorie" class="custom-select @error('categorie') is-invalid @enderror">
                                        <option value="">Sélectionner une catégorie</option>
                                        <option value="Particulier" {{ old('categorie', $client->categorie) == 'Particulier' ? 'selected' : '' }}>Particulier</option>
                                        <option value="Entreprise" {{ old('categorie', $client->categorie) == 'Entreprise' ? 'selected' : '' }}>Entreprise</option>

                                    </select>
                                    @error('categorie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Adresse</label>
                                    <textarea name="adresse" class="form-control @error('adresse') is-invalid @enderror" rows="2">{{ $client->adresse }}</textarea>
                                    @error('adresse')
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
@else
<p></p>
@endif