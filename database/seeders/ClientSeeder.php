<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    public function run()
    {
        // Exemple de 10 clients aléatoires
        for ($i = 1; $i <= 10; $i++) {
            Client::create([
                // id_client généré automatiquement par le modèle (booted())
                'nom_client' => "Client Test $i",
                'categorie'  => $i % 2 == 0 ? 'Entreprise' : 'Particulier',
                'telephone'  => '2296100000' . $i,
                'adresse'    => "Quartier Exemple $i, Cotonou",
            ]);
        }

        // Tu peux aussi créer un client précis si besoin
        Client::create([
            'nom_client' => "Bernard Dupont",
            'categorie'  => 'Particulier',
            'telephone'  => '22962001234',
            'adresse'    => "Akpakpa, Cotonou",
        ]);
    }
}
