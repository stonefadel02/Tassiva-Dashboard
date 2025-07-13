<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Client, Stock, Vente, Livraison, Finance, Livreur};
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Livreurs
        $livreur1 = Livreur::create([
            'nom_livreur' => 'Gérault Fanou',
            'telephone' => '0123456789',
            'zone_recouvrement' => 'Centre-ville',
        ]);
        $livreur2 = Livreur::create([
            'nom_livreur' => 'Marie Koffi',
            'telephone' => '0987654321',
            'zone_recouvrement' => 'Périphérie',
        ]);

        // Clients
        $client1 = Client::create([
            'id_client' => 'CL001',
            'nom_client' => 'Jean A.',
            'categorie' => 'Particulier',
            'telephone' => '1234567890',
            'adresse' => '123 Rue Test, Lomé',
            'date_ajout' => now(),
        ]);
        $client2 = Client::create([
            'id_client' => 'CL002',
            'nom_client' => 'Sophie T.',
            'categorie' => 'Entreprise',
            'telephone' => '0987654321',
            'adresse' => '456 Avenue Test, Lomé',
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
            'id_commande' => 'CMD001',
            'date_commande' => now(),
            'date_livraison' => now(),
            'id_client' => $client1->id_client,
            'nom_client' => 'Jean A.',
            'adresse_livraison' => '123 Rue Test',
            'moyen_livraison' => 'Camion',
            'statut_livraison' => 'Livrée',
            'delai_livraison' => '24h',
            'commentaires' => 'Livraison urgente',
            'livreur_id' => $livreur1->id,
        ]);
        Livraison::create([
            'id_commande' => 'CMD002',
            'date_commande' => now()->subDays(1),
            'date_livraison' => now(),
            'id_client' => $client2->id_client,
            'nom_client' => 'Sophie T.',
            'adresse_livraison' => '456 Rue Test',
            'moyen_livraison' => 'Moto',
            'statut_livraison' => 'En Cours',
            'delai_livraison' => '48h',
            'commentaires' => 'Client absent lors de la première tentative',
            'livreur_id' => $livreur2->id,
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