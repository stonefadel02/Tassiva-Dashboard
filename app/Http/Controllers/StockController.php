<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('stocks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'stock_initial' => 'required|integer|min:0',
            'entrees' => 'required|integer|min:0',
            'sorties' => 'required|integer|min:0',
            'stock_minimum' => 'required|integer|min:0',
        ]);

        $data = $request->all();
        $data['rupture'] = ($data['stock_initial'] + $data['entrees'] - $data['sorties']) <= $data['stock_minimum'];

        try {
            Stock::create($data);
            return redirect()->route('stocks.index')->with('success', 'Stock créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la création du stock : ' . $e->getMessage()]);
        }
    }

    public function show(Stock $stock)
    {
        return view('stocks.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock'));
    }


    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'entrees' => 'required|integer|min:0',
            'stock_minimum' => 'required|integer|min:0',
        ]);

        // Optionnel : conserver les valeurs existantes pour les champs non modifiables
        $data = $request->only(['nom_produit', 'entrees', 'stock_minimum']);
        $data['stock_initial'] = $stock->stock_initial;
        $data['sorties'] = $stock->sorties;

        $data['rupture'] = ($data['stock_initial'] + $data['entrees'] - $data['sorties']) <= $data['stock_minimum'];

        try {
            $stock->update($data);
            return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la mise à jour du stock : ' . $e->getMessage()]);
        }
    }


    public function destroy(Stock $stock)
    {
        try {
            $stock->delete();
            return redirect()->route('stocks.index')->with('success', 'Stock supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la suppression du stock : ' . $e->getMessage()]);
        }
    }

    public function reapprovisionner(Request $request, Stock $stock)
    {
        $request->validate([
            'entrees' => 'required|integer|min:0',
        ]);

        $stock->entrees += $request->entrees;
        $stock->rupture = ($stock->stock_initial + $stock->entrees - $stock->sorties) <= $stock->stock_minimum;

        try {
            $stock->save();
            return redirect()->route('stocks.index')->with('success', 'Stock réapprovisionné avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors du réapprovisionnement : ' . $e->getMessage()]);
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $stocks = Stock::where('nom_produit', 'LIKE', "%{$query}%")
            ->orWhere('rupture', true)
            ->get();

        return view('stocks.index', compact('stocks'));
    }

    public function addModal(Request $request)
    {
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'entrees' => 'required|integer|min:0',
            'stock_minimum' => 'required|integer|min:0',
        ]);

        $data = [
            'nom_produit' => $request->nom_produit,
            'stock_initial' => 0,
            'entrees' => $request->entrees,
            'sorties' => 0,
            'stock_minimum' => $request->stock_minimum,
            'rupture' => $request->entrees <= $request->stock_minimum,
        ];

        try {
            Stock::create($data);
            return redirect()->route('stocks.index')->with('success', 'Stock ajouté via modal avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de l\'ajout via modal : ' . $e->getMessage()]);
        }
    }
}