<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationPersonne extends Model
{
    use HasFactory;

    protected $table = 'reservation_personne';

    protected $fillable = [
        'id_reservation',
        'id_personne',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'id_reservation');
    }

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personne');
    }
}

