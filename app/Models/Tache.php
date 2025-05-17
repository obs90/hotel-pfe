<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
    ];

    public function employes()
    {
        return $this->belongsToMany(Employe::class, 'tache_employe')
                    ->withPivot('date_assignment', 'status');
    }
}

