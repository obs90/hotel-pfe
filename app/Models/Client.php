<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_client';

    protected $fillable = [
        'CIN',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(CustomUser::class, 'id_user');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_client');
    }
}

