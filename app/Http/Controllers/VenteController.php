<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Stock;
use App\Models\Client;
use App\Models\Livreur;
use App\Models\Livraison;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VenteController extends Controller
{
    // Afficher la liste des ventes
    public function index()
    {
        $ventes = Vente::with(['stock', 'client', 'livraison'])->get();
        $stocks = Stock::all();
        $clients = Client::all();   
        $livreurs = Livreur::all(); 

        return view('ventes.index', compact('ventes', 'stocks', 'clients', 'livreurs'));
    }


    // Afficher le formulaire de création d'une vente
    public function create()
    {
        $stocks = Stock::all();
        return view('ventes.create', compact('stocks'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:stocks,id',
            'client_id' => 'required|exists:clients,id',
            'quantite_vendue' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
            'mode_paiement' => 'required|string|max:255',
            'date_livraison' => 'nullable|date',
            'livreur_id' => 'nullable|exists:livreurs,id',
            'adresse_livraison' => 'nullable|string|max:255',
            'prix_livraison' => 'nullable|numeric|min:0',
        ]);

        // Récupérer le produit
        $stock = Stock::findOrFail($request->produit_id);
        $client = Client::findOrFail($request->client_id);

        // Vérification du stock disponible : Vérifier si la quantité demandée est disponible dans stock
        $stockDisponible = $stock->stock_initial + $stock->entrees - $stock->sorties;

        if ($request->quantite_vendue > $stockDisponible) {
            return redirect()->back()->withInput()->withErrors([
                'quantite_vendue' => "Stock insuffisant pour ce produit. Stock disponible : $stockDisponible unité(s)."
            ]);
        }




        // Enregistrement de la vente
        $vente = Vente::create([
            'date' => now(),
            'produit_id' => $stock->id,
            'id_client' => $client->id,
            'nom_produit' => $stock->nom_produit, // ← maintenant $stock est défini
            'quantite_vendue' => $request->quantite_vendue,
            'prix_unitaire' => $request->prix_unitaire,
            'mode_paiement' => $request->mode_paiement,
            'commentaires' => $request->commentaires,
        ]);



        // Mettre à jour le stock
        $stock->sorties += $request->quantite_vendue; // ajouter la vente aux sorties
        $stock->rupture = ($stock->stock_initial + $stock->entrees - $stock->sorties) <= $stock->stock_minimum;

        try {
            $stock->save();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la mise à jour du stock : ' . $e->getMessage()]);
        }

        

        if ($request->filled('date_livraison') && $request->filled('livreur_id')) {
            $dateLivraison = Carbon::parse($request->date_livraison);
            $now = Carbon::now();

            $delai = $now->diffInDays($dateLivraison, false);
            $delai_livraison = $delai < 0 ? 'Date invalide' : intval($delai) . ' jour(s)';

            Livraison::create([
                'id_commande' => $vente->id,
                'date_commande' => $now,
                'date_livraison' => $dateLivraison,
                'id_client' => $client->id,
                'nom_client' => $client->nom_client,
                'adresse_livraison' => $request->adresse_livraison,
                'moyen_livraison' => 'Aucun',
                'statut_livraison' => 'Non Livrée',
                'livreur_id' => $request->livreur_id,
                'delai_livraison' => $delai_livraison,
                'commentaires' => 'RAS',
            ]);
        }




        return redirect()->route('ventes.index')->with('success', 'Vente et livraison enregistrées avec succès.');
    }




    // Afficher les détails d'une vente
    public function show(Vente $vente)
    {
        return view('ventes.show', compact('vente'));
    }

    // Afficher le formulaire d'édition d'une vente
    public function edit(Vente $vente)
    {
        $stocks = Stock::all();
        return view('ventes.edit', compact('vente', 'stocks'));
    }

    // Mettre à jour une vente
    

    public function update(Request $request, Vente $vente)
    {
        $request->validate([
            'produit_id' => 'required|exists:stocks,id',
            'quantite_vendue' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
            'mode_paiement' => 'required|string|max:255',
        ]);

        // Récupérer le stock du produit sélectionné
        $stock = Stock::findOrFail($request->produit_id);

        // Calculer le stock disponible
        $stockDisponible = $stock->stock_initial + $stock->entrees - $stock->sorties;

        // Tenir compte de l’ancienne quantité vendue dans la vente
        if ($vente->produit_id == $stock->id) {
            // même produit : on ajoute la quantité déjà vendue au stock dispo
            $stockDisponible += $vente->quantite_vendue;
        }

        // Vérifier que la nouvelle quantité ne dépasse pas le stock dispo
        if ($request->quantite_vendue > $stockDisponible) {
            return redirect()->back()->withInput()->withErrors([
                'quantite_vendue' => "Stock insuffisant pour ce produit. Stock disponible : $stockDisponible unité(s)."
            ]);
        }

        // Mise à jour de la vente
        $ancienneQuantite = $vente->quantite_vendue;
        $nouvelleQuantite = $request->quantite_vendue;
        $diffQuantite = $nouvelleQuantite - $ancienneQuantite;

        $vente->update($request->all());

        // Mettre à jour les sorties dans le stock concerné
        $stock->sorties += $diffQuantite;
        $stock->rupture = ($stock->stock_initial + $stock->entrees - $stock->sorties) <= $stock->stock_minimum;
        $stock->save();

        return redirect()->route('ventes.index')->with('success', 'Vente mise à jour avec succès.');
    }



    // Supprimer une vente
    public function destroy(Vente $vente)
    {
        $vente->delete();
        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès.');
    }

    // public function destroy(Vente $vente)
    // {
    //     // Supprimer la livraison associée si elle existe
    //     // Livraison::where('id_commande', $vente->id)->delete();
    //     Livraison::where('id_commande', (string) $vente->id)->delete();

    //     // Supprimer la vente
    //     $vente->delete();
    //     return redirect()->route('ventes.index')->with('success', 'Vente et livraison supprimées avec succès.');
    // }

}