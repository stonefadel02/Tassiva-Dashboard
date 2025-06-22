<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Vente;
use App\Models\Stock;
use App\Models\Livraison;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Titre du tableau de bord
        $dashboard = "Tableau de bord - Tassiva";

        // Statistiques des stocks
        $totalProduitsEnStock = Stock::count();
        $produitsEnRupture = Stock::where('rupture', true)->count();
        $stocksEnRupture = Stock::where('rupture', true)->get();

        // Statistiques des ventes
        $ventes = Vente::with('stock')->get();
        $produitsVendus = Vente::select('nom_produit')
            ->selectRaw('SUM(quantite_vendue) as total_quantite')
            ->groupBy('nom_produit')
            ->get();
        $totalQuantiteVendue = Vente::sum('quantite_vendue');

        // Top 5 produits (basé sur la quantité vendue)
        $topProduits = Vente::select('nom_produit', 'produit_id')
            ->selectRaw('SUM(quantite_vendue) as total_quantite')
            ->groupBy('nom_produit', 'produit_id')
            ->orderByDesc('total_quantite')
            ->take(5)
            ->get();

        // Chiffre d'affaires
        $debutSemaine = Carbon::now()->startOfWeek();
        $finSemaine = Carbon::now()->endOfWeek();
        $chiffreAffaireSemaine = Vente::whereBetween('date', [$debutSemaine, $finSemaine])
            ->sum(\DB::raw('quantite_vendue * prix_unitaire'));

        $debutTroisMois = Carbon::now()->subMonths(3);
        $chiffreAffaireTroisMois = Vente::whereBetween('date', [$debutTroisMois, Carbon::now()])
            ->sum(\DB::raw('quantite_vendue * prix_unitaire'));

        // Chiffre d'affaires par mois pour le modal
        $chiffreAffaireParMois = Vente::selectRaw('MONTH(date) as month, YEAR(date) as year, SUM(quantite_vendue * prix_unitaire) as total')
            ->whereBetween('date', [$debutTroisMois, Carbon::now()])
            ->groupBy('month', 'year')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(3)
            ->get();

        // Statistiques des livraisons
        $aujourdHui = Carbon::today();
        $livraisonsParJour = Livraison::whereDate('date_livraison', $aujourdHui)->count();
        $dernieresLivraisons = Livraison::with('client')
            ->whereDate('date_livraison', $aujourdHui)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Top 5 clients (basé sur le montant total des ventes)
        $topClients = Vente::select('clients.id_client', 'clients.nom_client')
            ->join('clients', 'ventes.id_client', '=', 'clients.id_client')
            ->selectRaw('SUM(ventes.quantite_vendue * ventes.prix_unitaire) as total_achats')
            ->groupBy('clients.id_client', 'clients.nom_client')
            ->orderByDesc('total_achats')
            ->take(5)
            ->get();

        // Statistiques financières
        $soldeInitial = Company::first()->solde_initial ?? 0;
        $totalRecettes = Finance::where('entree_sortie', 'Entrée')->sum('montant');
        $totalDepenses = Finance::where('entree_sortie', 'Sortie')->sum('montant');
        // Utiliser le solde de la dernière transaction comme solde actuel
        $lastTransaction = Finance::orderBy('id', 'desc')->first();
        $soldeActuel = $lastTransaction ? $lastTransaction->solde : $soldeInitial;
        $benefices = $totalRecettes - $totalDepenses; // Garder pour compatibilité, mais soldeActuel est plus précis
        $nombreRecettes = Finance::where('entree_sortie', 'Entrée')->count();
        $nombreDepenses = Finance::where('entree_sortie', 'Sortie')->count();

        // Données pour le graphique des finances
        $revenus = Finance::where('entree_sortie', 'Entrée')
            ->selectRaw('MONTH(date) as month, SUM(montant) as total')
            ->whereBetween('date', [Carbon::now()->subMonths(3), Carbon::now()])
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
        $depenses = Finance::where('entree_sortie', 'Sortie')
            ->selectRaw('MONTH(date) as month, SUM(montant) as total')
            ->whereBetween('date', [Carbon::now()->subMonths(3), Carbon::now()])
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return view('dashboard.index', compact(
            'dashboard',
            'totalProduitsEnStock',
            'produitsEnRupture',
            'stocksEnRupture',
            'produitsVendus',
            'totalQuantiteVendue',
            'topProduits',
            'chiffreAffaireSemaine',
            'chiffreAffaireTroisMois',
            'chiffreAffaireParMois',
            'livraisonsParJour',
            'dernieresLivraisons',
            'topClients',
            'soldeInitial',
            'totalRecettes',
            'totalDepenses',
            'soldeActuel',
            'benefices',
            'nombreRecettes',
            'nombreDepenses',
            'revenus',
            'depenses'
        ));
    }
}