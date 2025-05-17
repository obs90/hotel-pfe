<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_reservation';

    protected $fillable = [
        'date_depart',
        'date_fin',
        'montant_total',
        'statut',
        'mode_paiement',
        'id_client',
        'id_chambre_tarif',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function chambreTarif()
    {
        return $this->belongsTo(ChambreTarif::class, 'id_chambre_tarif');
    }

    public function personnes()
    {
        return $this->belongsToMany(Personne::class, 'reservation_personne', 'id_reservation', 'id_personne');
    }
}

