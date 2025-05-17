<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tarif';

    protected $fillable = [
        'type',
        'description',
    ];

    public function chambres()
    {
        return $this->belongsToMany(Chambre::class, 'chambre_tarif', 'id_tarif', 'id_chambre')
                    ->withPivot('prix')
                    ->using(ChambreTarif::class)
                    ->as('tarification');
    }

    public function chambreTarifs()
    {
        return $this->hasMany(ChambreTarif::class, 'id_tarif');
    }
}
