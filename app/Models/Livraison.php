<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_commande',
        'date_livraison',
        'id_commande',
        'id_client',
        'nom_client',
        'adresse_livraison',
        'moyen_livraison',
        'statut_livraison',
        'commentaires',
    ];

    // Caster les dates en objets Carbon
    protected $dates = [
        'date_commande',
        'date_livraison',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client', 'id_client');
    }
}