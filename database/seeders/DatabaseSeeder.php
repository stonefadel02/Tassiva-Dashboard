<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Client, Stock, Vente, Livraison, Finance};
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Clients
        $client1 = Client::create([
            'id_client' => 'CL001',
            'nom_client' => 'Jean A.',
            'date_ajout' => now(),
        ]);
        $client2 = Client::create([
            'id_client' => 'CL002',
            'nom_client' => 'Sophie T.',
            'date_ajout' => now(),
        ]);

        // Stocks
        $stock1 = Stock::create([
            'nom_produit' => 'Jus Ananas',
            'stock_initial' => 200,
            'entrees' => 50,
            'sorties' => 145,
            'stock_minimum' => 10,
            'rupture' => false,
        ]);
        $stock2 = Stock::create([
            'nom_produit' => 'Jus de raisin',
            'stock_initial' => 150,
            'entrees' => 0,
            'sorties' => 123,
            'stock_minimum' => 5,
            'rupture' => true,
        ]);

        // Ventes
        Vente::create([
            'date' => now(),
            'produit_id' => $stock1->id,
            'nom_produit' => 'Jus Ananas',
            'id_client' => $client1->id_client,
            'quantite_vendue' => 50,
            'prix_unitaire' => 500,
            'mode_paiement' => 'Espèces',
        ]);
        Vente::create([
            'date' => now()->subDays(2),
            'produit_id' => $stock2->id,
            'nom_produit' => 'Jus de raisin',
            'id_client' => $client2->id_client,
            'quantite_vendue' => 30,
            'prix_unitaire' => 600,
            'mode_paiement' => 'Carte',
        ]);

        // Livraisons
        Livraison::create([
            'date_commande' => now()->format('Y-m-d'),
            'date_livraison' => now()->format('Y-m-d'),
            'id_client' => $client1->id_client,
            'nom_client' => 'Jean A.',
            'id_commande' => 'CMD001',
            'adresse_livraison' => '123 Rue Test',
            'moyen_livraison' => 'Camion',
            'statut_livraison' => 'Livré',
        ]);
        Livraison::create([
            'date_commande' => now()->subDays(1)->format('Y-m-d'),
            'date_livraison' => now()->format('Y-m-d'),
            'id_client' => $client2->id_client,
            'nom_client' => 'Sophie T.',
            'id_commande' => 'CMD002',
            'adresse_livraison' => '456 Rue Test',
            'moyen_livraison' => 'Moto',
            'statut_livraison' => 'En cours',
        ]);

        // Finances
        Finance::create([
            'date' => now()->format('Y-m-d'),
            'type_transaction' => 'Vente',
            'categorie' => 'Produits alimentaires',
            'description' => 'Vente produits',
            'montant' => 1250000,
            'entree_sortie' => 'Entrée',
            'solde' => 1250000,
        ]);
        Finance::create([
            'date' => now()->format('Y-m-d'),
            'type_transaction' => 'Dépense',
            'categorie' => 'Approvisionnement',
            'description' => 'Achat matières',
            'montant' => 850000,
            'entree_sortie' => 'Sortie',
            'solde' => 1250000 - 850000,
        ]);
    }
}