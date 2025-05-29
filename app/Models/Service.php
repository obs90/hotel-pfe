<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_service';

    protected $fillable = [
        'nom',
        'id_chef',
    ];

    public function chef()
    {
        return $this->belongsTo(Employe::class, 'id_chef');
    }

    // 👥 All employees working in this service
    public function employes()
    {
        return $this->hasMany(Employe::class, 'id_service');
    }
}

