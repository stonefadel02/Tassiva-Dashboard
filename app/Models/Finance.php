<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    // Champs remplissables
    protected $fillable = [
        'date',
        'type_transaction',
        'categorie',
        'description',
        'montant',
        'entree_sortie',
        'solde',
    ];
}