<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Client, Stock, Vente, Livraison, Finance, Livreur};
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
   public function run()
{
    $this->call([
        ClientSeeder::class,
    ]);
}
}