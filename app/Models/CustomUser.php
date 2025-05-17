<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class CustomUser extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'custom_users';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'password',
        'typeUser',
    ];

    protected $hidden = [
        'password',
    ];

    // JWT methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Relationships
    public function client()
    {
        return $this->hasOne(Client::class, 'id_user', 'id_user');
    }

    public function employe()
    {
        return $this->hasOne(Employe::class, 'id_user', 'id_user');
    }
}
