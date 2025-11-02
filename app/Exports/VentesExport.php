<?php

namespace App\Exports;

use App\Models\Vente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon; // N'oubliez pas d'importer Carbon pour formater les dates

class VentesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Récupère toutes les ventes
        return Vente::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Définit les titres des colonnes (identiques à votre tableau HTML)
        return [
            'N° de commande',
            'Date de la commande',
            'Nom Produit',
            'Quantité Vendue',
            'Prix Unitaire',
            'Total Vente',
            'Mode de Paiement',
            'Commentaires',
        ];
    }

    /**
     * @param mixed $vente
     * @return array
     */
    public function map($vente): array
    {
        // Formate chaque ligne de données
        return [
            $vente->id,
            Carbon::parse($vente->date)->format('d/m/Y H:i'), // Formate la date
            $vente->nom_produit,
            $vente->quantite_vendue,
            $vente->prix_unitaire,
            $vente->total_vente, // Utilise l'accesseur que vous avez ajouté
            $vente->mode_paiement,
            $vente->commentaires,
        ];
    }
}