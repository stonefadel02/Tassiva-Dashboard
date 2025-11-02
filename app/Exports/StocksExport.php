<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StocksExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Récupère tous les stocks, comme dans votre contrôleur
        return Stock::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Définit les titres des colonnes
        return [
            'ID',
            'Nom du produit',
            'Prix unitaire',
            'Stock Initial',
            'Entrées',
            'Sorties',
            'Stock Actuel',
            'Stock Minimum',
            'Rupture ?',
        ];
    }

    /**
     * @param mixed $stock
     * @return array
     */
    public function map($stock): array
    {
        // Formate chaque ligne de données
        // Assurez-vous que votre modèle Stock a un accesseur getStockActuelAttribute
        // comme le suggère votre vue (stock_actuel)
        return [
            $stock->id,
            $stock->nom_produit,
            number_format($stock->prix_unitaire, 0, ',', ' ') . ' FCFA',
            $stock->stock_initial,
            $stock->entrees,
            $stock->sorties,
            $stock->stock_actuel, // Cet attribut est utilisé dans votre vue
            $stock->stock_minimum,
            $stock->rupture ? 'OUI' : 'NON',
        ];
    }
}