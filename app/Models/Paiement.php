<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'mois',
        'annee',
        'date_paiement',
        'primes',
        'statut',
        'id_employe',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_employe');
    }
}

