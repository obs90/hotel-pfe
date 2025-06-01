<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_image';

    protected $fillable = [
        'url',
        'id_chambre',
    ];

    public function chambre()
    {
        return $this->belongsTo(Chambre::class, 'id_chambre');
    }
}
