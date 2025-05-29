<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_salaire';

    protected $fillable = [
        'mois',
        'annee',
        'date_paiement',
        'primes',
        'statut',
        'salaire_net',
        'id_employe',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_employe');
    }
}

