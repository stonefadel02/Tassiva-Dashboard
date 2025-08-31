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
        'prix_unitaire', 
        'stock_minimum',
        'rupture',
    ];
    protected $casts = [
    'prix_unitaire' => 'decimal:2',
];



    protected $appends = ['stock_actuel'];

    public function getStockActuelAttribute()
    {
        return (int) ($this->stock_initial + $this->entrees - $this->sorties);
    }

    // Relation : Un stock peut avoir plusieurs ventes
    public function ventes()
    {
        return $this->hasMany(Vente::class, 'produit_id');
    }
}