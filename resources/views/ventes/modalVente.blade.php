<!-- Modale Ajouter une commande - Version optimisée -->
<div class="modal fade" id="add-Vente-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une commande</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 1.25rem;">
                <form action="{{ route('ventes.store') }}" method="POST">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Colonne Commande -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Commande</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label>Nom produit</label>
                                                <select id="produit_id" name="produit_id" class="custom-select"
                                                    required>
                                                    <option value="" disabled selected>Choisir un produit</option>
                                                    @foreach ($stocks as $stock)
                                                        @php
                                                            $disponible =
                                                                $stock->stock_initial +
                                                                $stock->entrees -
                                                                $stock->sorties;
                                                        @endphp
                                                        <option value="{{ $stock->id }}"
                                                            data-prix="{{ $stock->prix_unitaire }}">
                                                            {{ $stock->nom_produit }} — dispo : {{ $disponible }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label>Nom du client</label>
                                                <select id="client_id" class="custom-select form-control-sm"
                                                    name="client_id">
                                                    <option selected disabled>Sélectionner un client...</option>
                                                    @foreach ($clients as $client)
                                                        <option data-adresse="{{ e($client->adresse) }}"
                                                            value="{{ $client->id_client }}">{{ $client->nom_client }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <a href="{{ route('clients.index') }}"
                                                    class="btn mt-2 btn-outline-primary btn-sm">
                                                    + Ajouter un client
                                                </a>

                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label>Quantité vendue</label>
                                                <input type="number" name="quantite_vendue" class="form-control"
                                                    required>
                                                @if ($errors->has('quantite_vendue'))
                                                    <small
                                                        class="text-danger">{{ $errors->first('quantite_vendue') }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label>Prix unitaire</label>
                                                <input type="number" step="0.01" min="0" name="prix_unitaire"
                                                    id="prix_unitaire" class="form-control" required>

                                            </div>
                                        </div>


                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label>Moyen de payement</label>
                                                <select name="mode_paiement" class="custom-select form-control-sm">
                                                    <option value="Espèces">En espèces</option>
                                                    <option value="Mobile Money">Mobile money</option>
                                                    <option value="Chèque">Chèque</option>
                                                    <option value="À la livraison">À la livraison</option>
                                                </select>

                                            </div>
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
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Livraison</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label>Date de livraison</label>
                                                <input type="datetime-local" name="date_livraison" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Attribuer à</label>
                                            <select name="livreur_id" class="custom-select">
                                                <option selected>Sélectionner un livreur...</option>
                                                @foreach ($livreurs as $livreur)
                                                    <option value="{{ $livreur->id }}">{{ $livreur->nom_livreur }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group mb-3">
                                            <label>Adresse de livraison</label>
                                            {{-- <textarea name="adresse_livraison" class="form-control" rows="2"></textarea> --}}
                                            <textarea id="adresse_livraison" name="adresse_livraison" class="form-control" rows="2"></textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Prix de livraison (FCFA)</label>
                                            <input type="number" step="0.01" min="0" id="prix_livraison"
                                                name="prix_livraison" class="form-control" value="0">
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
                                            <span id="resume-sous-total">0 FCFA</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Livraison :</span>
                                            <span id="resume-livraison">0 FCFA</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between font-weight-bold">
                                            <span>Total :</span>
                                            <span id="resume-total">0 FCFA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary mr-3"
                                        data-dismiss="modal">Annuler</button>
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
@if (isset($ventes) && $ventes->count() > 0)
    <div class="modal fade" id="viewVenteModal-{{ $vente->id }}" tabindex="-1" role="dialog"
        aria-hidden="true">
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
                                    <input type="text" name="nom_produit" class="form-control"
                                        value="{{ $vente->nom_produit }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Nom du client</label>
                                    <input type="text" name="nom_produit" class="form-control"
                                        value="{{ optional($vente->livraison)->nom_client ?? 'Non définie' }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Quantité Vendue</label>
                                    <input type="text" name="entrees" class="form-control"
                                        value="{{ $vente->quantite_vendue }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Prix Unitaire</label>
                                    <input type="text" name="nom_produit" class="form-control"
                                        value="{{ $vente->prix_unitaire }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Total d'achat</label>
                                    <input type="text" name="entrees" class="form-control"
                                        value="{{ $vente->total_vente }}" disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Mode de Paiement</label>
                                    <input type="text" name="" class="form-control"
                                        value="{{ $vente->mode_paiement }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Date de livraison</label>
                                    <input type="text" name="nom_produit" class="form-control"
                                        value="{{ optional($vente->livraison)->date_livraison ?? 'Non prévue' }}"
                                        disabled>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Statut de livraison</label>
                                    <input type="text" name="entrees" class="form-control"
                                        value="{{ optional($vente->livraison)->statut_livraison ?? 'Non définie' }}"
                                        disabled>
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
@if (isset($ventes) && $ventes->count() > 0)
    <div class="modal fade" id="editVenteModal-{{ $vente->id }}" tabindex="-1" role="dialog"
        aria-hidden="true">
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
                            <!-- <form action="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col">
                                        <label>Nom produit</label>
                                        <select name="produit_id" class="custom-select" required>
                                            <option value="" disabled {{ empty($vente->produit_id) ? 'selected' : '' }}>Choisir un produit</option>
                                            @foreach ($stocks as $stock)
<option value="{{ $stock->id }}" {{ $vente->produit_id == $stock->id ? 'selected' : '' }}>
                                                    {{ $stock->nom_produit }}
                                                </option>
@endforeach
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
                            <form> -->
                            <form action="{{ route('ventes.update', $vente->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col">
                                        <label>Nom produit</label>
                                        <select name="produit_id" class="custom-select" required>
                                            <option value="" disabled
                                                {{ empty($vente->produit_id) ? 'selected' : '' }}>Choisir un produit
                                            </option>
                                            @foreach ($stocks as $stock)
                                                <option value="{{ $stock->id }}"
                                                    {{ $vente->produit_id == $stock->id ? 'selected' : '' }}>
                                                    {{ $stock->nom_produit }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Quantité Vendue</label>
                                        <input type="number" name="quantite_vendue" class="form-control"
                                            value="{{ $vente->quantite_vendue }}" required>
                                    </div>
                                    <div class="col">
                                        <label class="mb-2">Prix Unitaire</label>
                                        <input type="number" name="prix_unitaire" class="form-control"
                                            value="{{ $vente->prix_unitaire }}" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Total d'achat</label>
                                        <input type="text" class="form-control"
                                            value="{{ $vente->quantite_vendue * $vente->prix_unitaire }}" disabled>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <label class="mb-2">Mode de Paiement</label>
                                        <select name="mode_paiement" class="custom-select" required>
                                            <option value="Espèces"
                                                {{ $vente->mode_paiement == 'Espèces' ? 'selected' : '' }}>En espèces
                                            </option>
                                            <option value="Mobile money"
                                                {{ $vente->mode_paiement == 'Mobile money' ? 'selected' : '' }}>Mobile
                                                money</option>
                                            <option value="Chèque"
                                                {{ $vente->mode_paiement == 'Chèque' ? 'selected' : '' }}>Chèque
                                            </option>
                                            <option value="À la livraison"
                                                {{ $vente->mode_paiement == 'À la livraison' ? 'selected' : '' }}>À la
                                                livraison</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-center justify-content-center">
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

<script>
    (function() {
        const fmt = n => (Number(n || 0)).toLocaleString('fr-FR') + ' FCFA';

        const $qte = document.querySelector('input[name="quantite_vendue"]');
        const $pu = document.querySelector('input[name="prix_unitaire"]');
        const $ship = document.getElementById('prix_livraison');

        const $st = document.getElementById('resume-sous-total');
        const $liv = document.getElementById('resume-livraison');
        const $tot = document.getElementById('resume-total');

        const $client = document.getElementById('client_id');
        const $addr = document.getElementById('adresse_livraison');

        function recalc() {
            const q = parseFloat($qte?.value || 0);
            const p = parseFloat($pu?.value || 0);
            const l = parseFloat($ship?.value || 0);
            const sous = q * p;
            const total = sous + l;
            if ($st) $st.textContent = fmt(sous);
            if ($liv) $liv.textContent = fmt(l);
            if ($tot) $tot.textContent = fmt(total);
        }

        // Auto-récalc sur saisie
        ['input', 'change'].forEach(ev => {
            $qte?.addEventListener(ev, recalc);
            $pu?.addEventListener(ev, recalc);
            $ship?.addEventListener(ev, recalc);
        });

        // Auto-remplir l'adresse quand on choisit un client (modifiable par l'utilisateur)
        $client?.addEventListener('change', function() {
            const opt = this.selectedOptions[0];
            const adr = opt ? opt.getAttribute('data-adresse') : '';
            // on remplit si vide, sinon on laisse la main à l'utilisateur
            if ($addr && !$addr.value) $addr.value = adr || '';
        });

        // init
        recalc();
    })();

    (function() {
        const fmt = n => (Number(n || 0)).toLocaleString('fr-FR') + ' FCFA';

        const $produit = document.getElementById('produit_id');
        const $qte = document.querySelector('input[name="quantite_vendue"]');
        const $pu = document.getElementById('prix_unitaire');
        const $ship = document.getElementById('prix_livraison');

        const $st = document.getElementById('resume-sous-total');
        const $liv = document.getElementById('resume-livraison');
        const $tot = document.getElementById('resume-total');

        function recalc() {
            const q = parseFloat($qte?.value || 0);
            const p = parseFloat($pu?.value || 0);
            const l = parseFloat($ship?.value || 0);
            const sous = q * p;
            const total = sous + l;
            if ($st) $st.textContent = fmt(sous);
            if ($liv) $liv.textContent = fmt(l);
            if ($tot) $tot.textContent = fmt(total);
        }

        // Au changement de produit, on met le prix du stock
        $produit?.addEventListener('change', function() {
            const opt = this.selectedOptions[0];
            const prix = opt ? opt.getAttribute('data-prix') : null;
            if ($pu && prix !== null) {
                $pu.value = prix;
                recalc();
            }
        });

        // Recalculs
        ['input', 'change'].forEach(ev => {
            $qte?.addEventListener(ev, recalc);
            $pu?.addEventListener(ev, recalc);
            $ship?.addEventListener(ev, recalc);
        });

        recalc();
    })();
</script>
