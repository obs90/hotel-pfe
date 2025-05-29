<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TacheEmploye extends Model
{
    use HasFactory;

    protected $table = 'tache_employe';
    
    protected $primaryKey = ['id_tache', 'id_employe'];

    protected $fillable = [
        'id_tache',
        'id_employe',
        'date_assignment',
        'status',
    ];

    public function tache()
    {
        return $this->belongsTo(Tache::class, 'id_tache');
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_employe');
    }
}

