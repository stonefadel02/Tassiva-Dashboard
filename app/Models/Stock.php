<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    // Champs remplissables (mass assignable)
    protected $fillable = [
        'nom_produit',
        'stock_initial',
        'entrees',
        'sorties',
        'stock_minimum',
        'rupture',
    ];

    // Relation : Un stock peut avoir plusieurs ventes
    public function ventes()
    {
        return $this->hasMany(Vente::class, 'produit_id');
    }
}