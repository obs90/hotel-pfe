<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'statut',
        'id_employe',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_employe');
    }
}

