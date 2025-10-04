<?php


// app/Models/Client.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_client';
public $incrementing = false;
protected $keyType = 'string';

    protected $fillable = [
        'id_client', // gardé pour affichage/lecture, mais généré côté serveur
        'nom_client',
        'categorie',
        'telephone',
        'adresse',
        'date_ajout',
    ];

    protected $casts = ['date_ajout' => 'datetime'];

    protected static function booted()
    {
        static::creating(function ($client) {
            if (empty($client->id_client)) {
                $client->id_client = 'CLI-'.now()->format('Ymd').'-'.strtoupper(Str::random(5));
            }
            if (empty($client->date_ajout)) {
                $client->date_ajout = now();
            }
        });

        static::updating(function ($client) {
            if ($client->isDirty('id_client')) {
                $client->id_client = $client->getOriginal('id_client');
            }
        });
    }

    // Relations (si vous liez les ventes par clé INT, préférez client_id partout)
    public function livraisons()
    {
        return $this->hasMany(Livraison::class, 'id_client', 'id_client');
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class, 'id_client', 'id_client');
    }
}
