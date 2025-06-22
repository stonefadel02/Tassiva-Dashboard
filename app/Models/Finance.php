<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'type_transaction',
        'categorie',
        'description',
        'montant',
        'entree_sortie',
        'solde',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public static function calculateSolde($montant, $entree_sortie)
    {
        $lastTransaction = self::orderBy('id', 'desc')->first();
        $soldeInitial = Company::first()->solde_initial ?? 0;
        $previousSolde = $lastTransaction ? $lastTransaction->solde : $soldeInitial;

        return $entree_sortie === 'Entrée' ? $previousSolde + $montant : $previousSolde - $montant;
    }
}