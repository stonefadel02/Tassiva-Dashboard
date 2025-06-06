<!-- modale pour rupture -->
<div class="modal fade" id="rupture-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Produits en rupture</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id produit</th>
                            <th scope="col">Nom produit</th>
                            <th scope="col">Quantite vendue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Jus Ananas</td>
                            <td>145</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jus de raisin</td>
                            <td>123</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Wisky</td>
                            <td>110</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Jus de coco</td>
                            <td>50</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Jus simple</td>
                            <td>30</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- modale pour stock -->
<div class="modal fade" id="stock-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Produits en stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id produit</th>
                            <th scope="col">Nom produit</th>
                            <th scope="col">Quantite vendue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Jus Ananas</td>
                            <td>145</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jus de raisin</td>
                            <td>123</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Wisky</td>
                            <td>110</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Jus de coco</td>
                            <td>50</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Jus simple</td>
                            <td>30</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modale Chiffre d'affaires -->
<div class="modal fade" id="ca-Modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Détail du chiffre d'affaires</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Mois</th>
              <th>Chiffre d'affaires</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Mai 2025</td>
              <td>43 900 FCFA</td>
            </tr>
            <tr>
              <td>Avril 2025</td>
              <td>980 000 FCFA</td>
            </tr>
            <tr>
              <td>Mars 2025</td>
              <td>875 000 FCFA</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Nombre de Livraison -->
<div class="modal fade" id="livraison-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Détail des Livraisons</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>25 Mai 2025</td>
                            <td>Jean A.</td>
                            <td>Jus de Bissap</td>
                            <td>6</td>
                        </tr>
                        <tr>
                            <td>24 Mai 2025</td>
                            <td>Sophie T.</td>
                            <td>Farine de manioc</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>23 Mai 2025</td>
                            <td>Paul K.</td>
                            <td>Jus d’ananas</td>
                            <td>10</td>
                        </tr>
                        <!-- Ajoute d'autres lignes si besoin -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Finance -->
<div class="modal fade" id="finance-Modal" tabindex="-1" role="dialog" aria-labelledby="financeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="financeModalLabel">Résumé Finance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Recettes</td>
                            <td>1 250 000 FCFA</td>
                        </tr>
                        <tr>
                            <td>Dépenses</td>
                            <td>850 000 FCFA</td>
                        </tr>
                        <tr>
                            <td>Bénéfice</td>
                            <td>400 000 FCFA</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
