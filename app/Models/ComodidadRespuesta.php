<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComodidadRespuesta extends Model
{
    use HasFactory;

    protected $table = 'comodidades_respuestas';

    protected $fillable = [
        'id_comodidad',
        'id_caracteristica_comodidad',
        'id_caracteristica_esperada',
    ];

}
