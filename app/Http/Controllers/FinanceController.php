<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Company;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $finances = Finance::all();
        return view('finances.index', compact('finances'));
    }

    public function create()
    {
        return view('finances.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'type_transaction' => 'required|string|in:Dépôt,Retrait',
            'categorie' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'entree_sortie' => 'required|in:Entrée,Sortie',
        ]);

        try {
            $data = $request->all();
            $data['solde'] = Finance::calculateSolde($data['montant'], $data['entree_sortie']);
            Finance::create($data);
            return redirect()->route('finances.index')->with('success', 'Transaction enregistrée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur : ' . $e->getMessage()]);
        }
    }

    public function show(Finance $finance)
    {
        return view('finances.show', compact('finance'));
    }

    public function edit(Finance $finance)
    {
        return view('finances.edit', compact('finance'));
    }

    public function update(Request $request, Finance $finance)
    {
        $request->validate([
            'date' => 'required|date',
            'type_transaction' => 'required|string|in:Dépôt,Retrait',
            'categorie' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'entree_sortie' => 'required|in:Entrée,Sortie',
        ]);

        try {
            $data = $request->all();
            $data['solde'] = Finance::calculateSolde($data['montant'], $data['entree_sortie']);
            $finance->update($data);
            return redirect()->route('finances.index')->with('success', 'Transaction mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur : ' . $e->getMessage()]);
        }
    }

    public function destroy(Finance $finance)
    {
        try {
            $finance->delete();
            // Recalculer les soldes des transactions suivantes
            $this->recalculateSoldes();
            return redirect()->route('finances.index')->with('success', 'Transaction supprimée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur : ' . $e->getMessage()]);
        }
    }

    private function recalculateSoldes()
    {
        $transactions = Finance::orderBy('id')->get();
        $soldeInitial = Company::first()->solde_initial ?? 0;
        $solde = $soldeInitial;

        foreach ($transactions as $transaction) {
            $solde = $transaction->entree_sortie === 'Entrée' ? $solde + $transaction->montant : $solde - $transaction->montant;
            $transaction->update(['solde' => $solde]);
        }
    }
}