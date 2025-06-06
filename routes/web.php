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



// Route par défaut (page d'accueil)
//Route::get('/', function () {
    //return view('welcome'); // Vous pouvez remplacer cela par votre tableau de bord plus tard
//});

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



Route::get('/', [DashboardController::class, 'index']);

Route::get('clients', [ClientController::class, 'index']);
Route::get('list_livreur', [LivreurController::class, 'index']);

// Route pour le profil utilisateur
Route::get('/profil', [ProfileController::class, 'index'])->name('profil');