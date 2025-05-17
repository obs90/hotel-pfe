<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    protected $table = 'personnes'; 
    protected $primaryKey = 'id_personne';

    protected $fillable = [
        'nom',
        'prenom',
        'CIN',
    ];

    public function reservations()
{
    return $this->belongsToMany(Reservation::class, 'reservation_personne', 'id_personne', 'id_reservation');
}
}

