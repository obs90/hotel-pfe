<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ChambreTarif extends Pivot
{
    use HasFactory;

    protected $table = 'chambre_tarif'; // explicitly define table
    protected $primaryKey = 'id_chambre_tarif'; // explicitly define primary key

    protected $fillable = [
        'id_chambre',
        'id_tarif',
        'prix'
    ];

    public $timestamps = false; // optional, since your pivot doesn’t have timestamps

    public function chambre()
    {
        return $this->belongsTo(Chambre::class, 'id_chambre');
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_chambre_tarif');
    }
}
