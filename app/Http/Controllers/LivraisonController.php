<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Livreur;
use App\Models\Livraison;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    public function index()
    {
        $livraisons = Livraison::with(['client', 'livreur'])->get();
        $clients = Client::all();
        $livreurs = Livreur::all();
        return view('livraisons.index', compact('livraisons', 'clients', 'livreurs'));
    }

    public function create()
    {
        $clients = Client::all();
        $livreurs = Livreur::all();
        return view('livraisons.create', compact('clients', 'livreurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_commande' => 'required|string|unique:livraisons,id_commande',
            'date_commande' => 'required|date',
            'date_livraison' => 'required|date',
            'id_client' => 'required|string|exists:clients,id_client',
            'nom_client' => 'required|string|max:255',
            'adresse_livraison' => 'required|string|max:255',
            'moyen_livraison' => 'required|string|in:Bus,Entreprise,Baché,Gozem,Camion,Moto,Livreur,Aucun',
            'statut_livraison' => 'required|string|in:Livrée,Non Livrée,En Cours',
            'livreur_id' => 'nullable|exists:livreurs,id',
            'delai_livraison' => 'nullable|string|max:255',
            'commentaires' => 'nullable|string',
        ]);

        try {
            Livraison::create($request->all());
            return redirect()->route('livraisons.index')->with('success', 'Livraison ajoutée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur : ' . $e->getMessage()]);
        }
    }

    public function edit(Livraison $livraison)
    {
        $clients = Client::all();
        $livreurs = Livreur::all();
        return view('livraisons.edit', compact('livraison', 'clients', 'livreurs'));
    }


    public function update(Request $request, Livraison $livraison)
    {

        $request->validate([
            'date_livraison' => 'required|date',
            'nom_client' => 'required|string|max:255',
            'adresse_livraison' => 'required|string|max:255',
            'moyen_livraison' => 'required|string|in:Bus,Entreprise,Baché,Gozem,Camion,Moto,Livreur,Aucun',
            'statut_livraison' => 'required|string|in:Livrée,Non Livrée,En Cours',
            'livreur_id' => 'nullable|exists:livreurs,id',
            'delai_livraison' => 'nullable|string|max:255',
            'commentaires' => 'nullable|string',
        ]);


        try {
            // Si le champ livreur est vide, Laravel le passera à null automatiquement
            $livraison->update($request->all());
            return redirect()->route('livraisons.index')->with('success', 'Livraison mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur : ' . $e->getMessage()]);
        }
    }


    public function destroy(Livraison $livraison)
    {
        try {
            $livraison->delete();
            return redirect()->route('livraisons.index')->with('success', 'Livraison supprimée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur : ' . $e->getMessage()]);
        }
    }
}