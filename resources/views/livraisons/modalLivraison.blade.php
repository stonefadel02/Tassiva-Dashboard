<!-- Voir une livraison  -->
@if(isset($livraisons) && $livraisons->count() > 0)
    <div class="modal fade" id="viewlivraisonModal-{{ $livraison->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Information de livraison</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-5">
                    <div class="popup text-left">
                        <div class="content create-workform bg-body">
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nom Client</label>
                                    <input type="text" name="nom_produit" class="form-control" value="{{ $livraison->nom_client }}" disabled >
                                </div>
                                <div class="col">
                                    <label class="mb-2">N° de commande</label>
                                    <input type="text" name="entrees" class="form-control" value="{{ $livraison->id_commande }}" disabled >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Date Commande</label>
                                    <input type="text" name="nom_produit" class="form-control" value="{{ $livraison->date_commande }}" disabled >
                                </div>
                                <div class="col">
                                    <label class="mb-2">Date Livraison</label>
                                    <input type="text" name="entrees" class="form-control" value="{{ $livraison->date_livraison }}" disabled >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Adresse Livraison</label>
                                    <input type="text" name="nom_produit" class="form-control" value="{{ $livraison->adresse_livraison }}" disabled >
                                </div>
                                <div class="col">
                                    <label class="mb-2">Moyen de livraison</label>
                                    <input type="text" name="entrees" class="form-control" value="{{ $livraison->moyen_livraison }}" disabled >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Statut de livraison</label>
                                    <input type="text" name="" class="form-control" value="{{ $livraison->statut_livraison }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Livré par</label>
                                    <input type="text" name="entrees" class="form-control" value="Gerault FANOU" disabled >
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




<!-- Editer une livraison  -->
@if(isset($livraisons) && $livraisons->count() > 0)
    <div class="modal fade" id="editlivraisonModal-{{ $livraison->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Information de livraison</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="popup text-left">
                        <div class="content create-workform bg-body">
                            <form action="{{ route('livraisons.update', $livraison->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Nom Client</label>
                                        <input type="text" name="nom_produit" class="form-control" value="{{ $livraison->nom_client }}" required >
                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Date Livraison</label>
                                        <input type="datetime-local" name="entrees" class="form-control" value="{{ $livraison->date_livraison }}" required >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Adresse Livraison</label>
                                        <input type="text" name="nom_produit" class="form-control" value="{{ $livraison->adresse_livraison }}" required >
                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Moyen de livraison</label>
                                        <!-- <input type="text" name="entrees" class="form-control" value="{{ $livraison->moyen_livraison }}" required > -->
                                        <select class="custom-select">
                                            <option selected>Bus</option>
                                            <option value="1">Moto</option>
                                            <option value="2">Baché</option>
                                            <option value="3">Gozem</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Statut de livraison</label>
                                        <select class="custom-select">
                                            <option selected>Livrée</option>
                                            <option value="1">Non Livree</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Livré par</label>
                                        <select class="custom-select">
                                            <option selected>Gerault FANOU</option>
                                            <option value="1">Amour DJIKA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <div class="btn btn-primary mr-4" data-dismiss="modal">Annuler</div>
                                        <div type="submit" class="btn btn-outline-primary" data-dismiss="modal">Mettre à jour</div>
                                    </div>
                                </div>
                            <form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <p></p>
@endif
