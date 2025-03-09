<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\FinanceController;


// Route par défaut (page d'accueil)
Route::get('/', function () {
    return view('welcome'); // Vous pouvez remplacer cela par votre tableau de bord plus tard
});

// Routes pour les Stocks
Route::resource('stocks', StockController::class);

// Routes pour les Ventes
Route::resource('ventes', VenteController::class);

// Routes pour les Livraisons
Route::resource('livraisons', LivraisonController::class);

// Routes pour les Finances
Route::resource('finances', FinanceController::class);