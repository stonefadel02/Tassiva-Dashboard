<?php

namespace App\Http\Controllers;

use App\Models\Livraison;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    // Afficher la liste des livraisons
    public function index()
    {
        $livraisons = Livraison::all();
        return view('livraisons.index', compact('livraisons'));
    }

    // Afficher le formulaire de création d'une livraison
    public function create()
    {
        return view('livraisons.create');
    }

    // Enregistrer une nouvelle livraison
    public function store(Request $request)
    {
        $request->validate([
            'date_commande' => 'required|date',
            'date_livraison' => 'required|date',
            'id_commande' => 'required|string|max:255',
            'id_client' => 'required|string|max:255',
            'nom_client' => 'required|string|max:255',
            'adresse_livraison' => 'required|string|max:255',
            'moyen_livraison' => 'required|string|max:255',
            'statut_livraison' => 'required|string|max:255',
        ]);

        Livraison::create($request->all());

        return redirect()->route('livraisons.index')->with('success', 'Livraison enregistrée avec succès.');
    }

    // Afficher les détails d'une livraison
    public function show(Livraison $livraison)
    {
        return view('livraisons.show', compact('livraison'));
    }

    // Afficher le formulaire d'édition d'une livraison
    public function edit(Livraison $livraison)
    {
        return view('livraisons.edit', compact('livraison'));
    }

    // Mettre à jour une livraison
    public function update(Request $request, Livraison $livraison)
    {
        $request->validate([
            'date_commande' => 'required|date',
            'date_livraison' => 'required|date',
            'id_commande' => 'required|string|max:255',
            'id_client' => 'required|string|max:255',
            'nom_client' => 'required|string|max:255',
            'adresse_livraison' => 'required|string|max:255',
            'moyen_livraison' => 'required|string|max:255',
            'statut_livraison' => 'required|string|max:255',
        ]);

        $livraison->update($request->all());

        return redirect()->route('livraisons.index')->with('success', 'Livraison mise à jour avec succès.');
    }

    // Supprimer une livraison
    public function destroy(Livraison $livraison)
    {
        $livraison->delete();
        return redirect()->route('livraisons.index')->with('success', 'Livraison supprimée avec succès.');
    }
}