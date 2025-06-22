<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;

class LivreurController extends Controller
{
    public function index()
    {
        $livreurs = Livreur::all();
        return view('livreurs.index', compact('livreurs'));
    }

    public function create()
    {
        return view('livreurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_livreur' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'zone_recouvrement' => 'nullable|string',
        ]);

        try {
            Livreur::create($request->all());
            return redirect()->route('livreurs.index')->with('success', 'Livreur ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de l\'ajout du livreur : ' . $e->getMessage()]);
        }
    }

    public function show(Livreur $livreur)
    {
        return view('livreurs.show', compact('livreur'));
    }

    public function edit(Livreur $livreur)
    {
        return view('livreurs.edit', compact('livreur'));
    }

    public function update(Request $request, Livreur $livreur)
    {
        $request->validate([
            'nom_livreur' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'zone_recouvrement' => 'nullable|string',
        ]);

        try {
            $livreur->update($request->all());
            return redirect()->route('livreurs.index')->with('success', 'Livreur mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la mise à jour du livreur : ' . $e->getMessage()]);
        }
    }

    public function destroy(Livreur $livreur)
    {
        try {
            $livreur->delete();
            return redirect()->route('livreurs.index')->with('success', 'Livreur supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur lors de la suppression du livreur : ' . $e->getMessage()]);
        }
    }
}