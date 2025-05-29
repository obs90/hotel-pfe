<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_employe';

    protected $fillable = [
        'salaire',
        'date_naissance',
        'adresse',
        'CIN',
        'date_embauche',
        'fonction',
        'id_user',
        'id_service',
    ];

    public function user()
    {
        return $this->belongsTo(CustomUser::class, 'id_user');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

    public function paiement()
    {
        return $this->hasMany(Paiement::class, 'id_employe');
    }

    public function conges()
    {
        return $this->hasMany(Conge::class, 'id_employe');
    }

    public function taches()
    {
        return $this->belongsToMany(Tache::class, 'tache_employe')
                    ->withPivot('date_assignment', 'status');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'id_employe');
    }
}

