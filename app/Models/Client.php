<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_client',
        'nom_client',
        'categorie',
        'telephone',
        'adresse',
        'date_ajout',
    ];
    protected $casts = [
    'date_ajout' => 'datetime',
];

    // Relation : Un client peut avoir plusieurs livraisons
    public function livraisons()
    {
        return $this->hasMany(Livraison::class, 'id_client', 'id_client');
    }

    // Relation : Un client peut avoir plusieurs ventes (si lié à Vente)
    public function ventes()
    {
        return $this->hasMany(Vente::class, 'id_client', 'id_client');
    }
}