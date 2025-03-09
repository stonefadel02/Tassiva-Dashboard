<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Stock;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    // Afficher la liste des ventes
    public function index()
    {
        $ventes = Vente::with('stock')->get();
        return view('ventes.index', compact('ventes'));
    }

    // Afficher le formulaire de création d'une vente
    public function create()
    {
        $stocks = Stock::all();
        return view('ventes.create', compact('stocks'));
    }

    // Enregistrer une nouvelle vente
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'produit_id' => 'required|exists:stocks,id',
            'quantite_vendue' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
            'mode_paiement' => 'required|string|max:255',
        ]);

        Vente::create($request->all());

        return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès.');
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
            'date' => 'required|date',
            'produit_id' => 'required|exists:stocks,id',
            'quantite_vendue' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
            'mode_paiement' => 'required|string|max:255',
        ]);

        $vente->update($request->all());

        return redirect()->route('ventes.index')->with('success', 'Vente mise à jour avec succès.');
    }

    // Supprimer une vente
    public function destroy(Vente $vente)
    {
        $vente->delete();
        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès.');
    }
}