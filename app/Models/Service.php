<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'id_chef',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_chef');
    }
}

