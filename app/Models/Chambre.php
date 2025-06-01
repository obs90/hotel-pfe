<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_chambre';

    protected $fillable = [
        'type',
        'description',
        'base_price',
        'capacite',
        'disponibilite',
    ];

    // If each chambre has a default/base tarif (1-to-1 or many-to-1)
    // public function tarif()
    // {
    //     return $this->belongsTo(Tarif::class, 'id_Tarif');
    // }

    // Many-to-many relationship with Tarif through the pivot model
    public function tarifs()
    {
        return $this->belongsToMany(Tarif::class, 'chambre_tarif', 'id_chambre', 'id_tarif')
                    ->withPivot('prix')
                    ->using(ChambreTarif::class)
                    ->as('tarification');
    }

    public function chambreTarifs()
    {
        return $this->hasMany(ChambreTarif::class, 'id_chambre');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'id_chambre');
    }
}
