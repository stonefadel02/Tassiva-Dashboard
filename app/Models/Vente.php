<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'produit_id',
        'nom_produit',
        'quantite_vendue',
        'prix_unitaire',
        'mode_paiement',
        'id_client',
        'commentaires',
    ];

    // Relation : Une vente appartient à un produit (stock)
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'produit_id');
    }

    public function getTotalVenteAttribute()
    {
        // Multiplie la quantité par le prix unitaire
        return $this->quantite_vendue * $this->prix_unitaire;
    }

    // Relation : Une vente appartient à un client
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client', 'id_client');
    }

    public function livraison()
    {
        return $this->hasOne(Livraison::class, 'id_commande');
    }

}