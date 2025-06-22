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
        'delai_livraison',
        'commentaires',
        'livreur_id',
    ];

    protected $casts = [
        'date_commande' => 'datetime',
        'date_livraison' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client', 'id_client');
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
}