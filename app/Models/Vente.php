<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    // Champs remplissables
    protected $fillable = [
        'date',
        'produit_id',
        'nom_produit',
        'quantite_vendue',
        'prix_unitaire',
        'mode_paiement',
        'commentaires',
    ];

    // Relation : Une vente appartient à un produit (stock)
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'produit_id');
    }
}