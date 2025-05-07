<div class="modal fade" id="new-product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Nouveau produit</h4>
                    <div class="content create-workform bg-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nom du produits</label>
                                    <input type="text" name="nom_produit" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Categories</label>
                                    <select class="custom-select">
                                        <option selected>Selectionner une catégorie...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Prix</label>
                                    <input type="number" name="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <div class="btn btn-primary mr-4" data-dismiss="modal">Annuler</div>
                                    <div class="btn btn-outline-primary" data-dismiss="modal">Ajouter</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



