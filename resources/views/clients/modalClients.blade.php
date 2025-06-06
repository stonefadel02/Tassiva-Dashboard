<!-- Ajouter du stocks  -->
<div class="modal fade" id="add-Client-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="popup text-left">
                    <div class="content create-workform bg-body">
                        <form action="{{ route('livraisons.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nom du Client</label>
                                    <input type="text" name="nom_livreur" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Téléphone</label>
                                    <input type="number" name="entrees" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Adresse</label>
                                    <textarea class="form-control" id="" name="" rows="2" ></textarea>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Catégorie</label>
                                    <textarea class="form-control" id="" name="" rows="2" ></textarea>
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

