<!-- Modale Ajouter une commande - Version optimisée -->
<div class="modal fade" id="add-Vente-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 850px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une commande</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" style="padding: 1.25rem;">
                <form action="" method="POST">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Colonne Commande -->
                            <div class="col-md-6">
                                <div class="card" style="margin-bottom: 1.5rem;">
                                    <div class="card-header">
                                        <h5 class="card-title">Commande</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label>Nom produit</label>
                                                <select class="custom-select form-control-sm">
                                                    <option selected>Sélectionner un produit...</option>
                                                    <option value="1">Jus d'ananas</option>
                                                    <option value="2">Jus de raisin</option>
                                                    <option value="3">Poulet</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label>Nom du client</label>
                                                <select class="custom-select form-control-sm">
                                                    <option selected>Sélectionner un client...</option>
                                                    <option value="1">Jean luis Viané</option>
                                                    <option value="2">Ana Dorez</option>
                                                    <option value="3">Tantu bayo</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label>Quantité vendue</label>
                                            <input type="number" name="quantite" class="form-control form-control-sm" required>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label>Prix unitaire</label>
                                            <input type="number" name="prix_unitaire" class="form-control form-control-sm" required>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label>Mode de paiement</label>
                                            <select class="custom-select form-control-sm">
                                                <option selected>En espèces</option>
                                                <option value="1">Mobile money</option>
                                                <option value="2">Chèque</option>
                                                <option value="3">A la livraison</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Commentaires</label>
                                            <textarea class="form-control form-control-sm" name="commentaires" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Colonne Livraison -->
                            <div class="col-md-6">
                                <div class="card" style="margin-bottom: 1.5rem;">
                                    <div class="card-header">
                                        <h5 class="card-title">Livraison</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label>Date de livraison</label>
                                                <input type="datetime-local" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label>Attribuer à</label>
                                            <select class="custom-select form-control-sm">
                                                <option selected>Sélectionner un livreur...</option>
                                                <option value="1">Jean luis Viané</option>
                                                <option value="2">Ana Dorez</option>
                                                <option value="3">Tantu bayo</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label>Adresse de livraison</label>
                                            <textarea class="form-control form-control-sm" rows="2"></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Prix livraison</label>
                                            <input type="number" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Résumé de commande -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Résumé de la commande</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Sous-total :</span>
                                            <span>48 000 FCFA</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Livraison :</span>
                                            <span>2 000 FCFA</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between font-weight-bold">
                                            <span>Total :</span>
                                            <span>50 000 FCFA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Boutons -->
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Voir une commande  -->
@if(isset($ventes) && $ventes->count() > 0)
    <div class="modal fade" id="viewVenteModal-{{ $vente->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Information de commande</h4>
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
                                    <input type="text" name="nom_produit" class="form-control" value="{{ $vente->nom_produit }}" disabled >
                                </div>
                                <div class="col">
                                    <label class="mb-2">Nom du client</label>
                                    <input type="text" name="nom_produit" class="form-control" value="Tata Bayo" disabled >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Quantité Vendue</label>
                                    <input type="text" name="entrees" class="form-control" value="{{ $vente->quantite_vendue }}" disabled >
                                </div>
                                <div class="col">
                                    <label class="mb-2">Prix Unitaire</label>
                                    <input type="text" name="nom_produit" class="form-control" value="{{ $vente->prix_unitaire }}" disabled >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Total d'achat</label>
                                    <input type="text" name="entrees" class="form-control" value="{{ $vente->total_vente }}" disabled >
                                </div>
                                <div class="col">
                                    <label class="mb-2">Mode de Paiement</label>
                                    <input type="text" name="" class="form-control" value="{{ $vente->mode_paiement }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Date de livraison</label>
                                    <input type="text" name="nom_produit" class="form-control" value="25/12/1111" disabled >
                                </div>
                                <div class="col">
                                    <label class="mb-2">Statut de livraison</label>
                                    <input type="text" name="entrees" class="form-control" value="Livrée" disabled >
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




<!-- Editer une commande  -->
@if(isset($ventes) && $ventes->count() > 0)
    <div class="modal fade" id="editVenteModal-{{ $vente->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier une commande</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="popup text-left">
                        <div class="content create-workform bg-body">
                            <form action="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Nom du produits</label>
                                        <select class="custom-select">
                                            <option selected>Jus d'ananas</option>
                                            <option value="1">Jus d'ananas</option>
                                            <option value="2">Jus de raisin</option>
                                            <option value="3">Poulet</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Nom du client</label>
                                        <select class="custom-select">
                                            <option value="1">Jean luis Viané</option>
                                            <option value="2">Ana Dorez</option>
                                            <option value="3">Tantu bayo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Quantité Vendue</label>
                                        <input type="number" name="entrees" class="form-control" value="{{ $vente->quantite_vendue }}" required >
                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Prix Unitaire</label>
                                        <input type="number" name="nom_produit" class="form-control" value="{{ $vente->prix_unitaire }}" required >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Total d'achat</label>
                                        <input type="text" name="entrees" class="form-control" value="{{ $vente->total_vente }}" required >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Mode de Paiement</label>
                                        <select class="custom-select">
                                            <option selected>En espèces</option>
                                            <option value="1">Mobile monney</option>
                                            <option value="2">Chèque</option>
                                            <option value="2">A la livraiosn</option>
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