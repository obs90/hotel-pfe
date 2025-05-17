<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'justifie',
        'id_employe',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_employe');
    }
}

