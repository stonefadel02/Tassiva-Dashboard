<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // Afficher la liste des stocks
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    // Afficher le formulaire de création d'un stock
    public function create()
    {
        return view('stocks.create');
    }

    // Enregistrer un nouveau stock
    public function store(Request $request)
    {
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'stock_initial' => 'required|integer|min:0',
            'entrees' => 'required|integer|min:0',
            'sorties' => 'required|integer|min:0',
            'stock_minimum' => 'required|integer|min:0',
        ]);

        Stock::create($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stock créé avec succès.');
    }

    // Afficher les détails d'un stock
    public function show(Stock $stock)
    {
        return view('stocks.show', compact('stock'));
    }

    // Afficher le formulaire d'édition d'un stock
    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock'));
    }

    // Mettre à jour un stock
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'stock_initial' => 'required|integer|min:0',
            'entrees' => 'required|integer|min:0',
            'sorties' => 'required|integer|min:0',
            'stock_minimum' => 'required|integer|min:0',
        ]);

        $stock->update($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès.');
    }

    // Supprimer un stock
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock supprimé avec succès.');
    }
}