<!-- Ajouter un livreur -->
<div class="modal fade" id="add-Livreur-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un livreur</h4>
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
                        <form action="{{ route('livreurs.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nom du livreur</label>
                                    <input type="text" name="nom_livreur" class="form-control @error('nom_livreur') is-invalid @enderror" value="{{ old('nom_livreur') }}" required>
                                    @error('nom_livreur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Téléphone</label>
                                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}" required>
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Zone de recouvrement</label>
                                    <textarea class="form-control @error('zone_recouvrement') is-invalid @enderror" name="zone_recouvrement" rows="2">{{ old('zone_recouvrement') }}</textarea>
                                    @error('zone_recouvrement')
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