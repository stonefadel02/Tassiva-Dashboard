<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    // Afficher la liste des transactions financières
    public function index()
    {
        $finances = Finance::all();
        return view('finances.index', compact('finances'));
    }

    // Afficher le formulaire de création d'une transaction
    public function create()
    {
        return view('finances.create');
    }

    // Enregistrer une nouvelle transaction
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'type_transaction' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'entree_sortie' => 'required|in:Entrée,Sortie',
        ]);

        Finance::create($request->all());

        return redirect()->route('finances.index')->with('success', 'Transaction enregistrée avec succès.');
    }

    // Afficher les détails d'une transaction
    public function show(Finance $finance)
    {
        return view('finances.show', compact('finance'));
    }

    // Afficher le formulaire d'édition d'une transaction
    public function edit(Finance $finance)
    {
        return view('finances.edit', compact('finance'));
    }

    // Mettre à jour une transaction
    public function update(Request $request, Finance $finance)
    {
        $request->validate([
            'date' => 'required|date',
            'type_transaction' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'entree_sortie' => 'required|in:Entrée,Sortie',
        ]);

        $finance->update($request->all());

        return redirect()->route('finances.index')->with('success', 'Transaction mise à jour avec succès.');
    }

    // Supprimer une transaction
    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('finances.index')->with('success', 'Transaction supprimée avec succès.');
    }
}