<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Routes publiques (non protégées par authentification)
|--------------------------------------------------------------------------
*/

// Connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Routes protégées par authentification (middleware "auth")
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Page d'accueil / Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    
    // Autre tableau de bord alternatif
    Route::get('/dashboard', function () {
        return 'Bienvenue dans le dashboard !';
    });

    // Routes pour les Stocks
    Route::resource('stocks', StockController::class);
    Route::post('stocks/{stock}/reapprovisionner', [StockController::class, 'reapprovisionner'])->name('stocks.reapprovisionner');
    Route::get('stocks/search', [StockController::class, 'search'])->name('stocks.search');
    Route::post('stocks/add-modal', [StockController::class, 'addModal'])->name('stocks.addModal');

    // Routes pour les Ventes
    Route::resource('ventes', VenteController::class);

    // Routes pour les Livraisons
    Route::resource('livraisons', LivraisonController::class);

    // Routes pour les Finances
    Route::resource('finances', FinanceController::class);

    // Routes pour les Clients
    Route::resource('clients', ClientController::class);

    // Routes pour les Livreurs
    Route::resource('livreurs', LivreurController::class);
    Route::get('list_livreur', [LivreurController::class, 'index']);

    // Route du profil utilisateur
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');

});
