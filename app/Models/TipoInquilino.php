<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInquilino extends Model
{
    use HasFactory;

    protected $table = 'tipo_inquilino';

    protected $fillable = [
        'nombre_tipo_inquilino',
    ];

    //muchos TipoInquilino a muchos PublicacionTipoInquilino
    public function publicacionTipoInquilino()
    {
        return $this->belongsToMany(Publicacion::class, 'publicacion_tipo_inquilino', 'id_tipo_inquilino', 'id_publicacion');
    }

    //muchos TipoInquilino a muchos CaracteristicaEsperada
    public function caracteristicaEsperada()
    {
        return $this->belongsToMany(CaracteristicaEsperada::class, 'tipo_inquilino_respuesta', 'id_tipo_inquilino', 'id_caracteriticas_esperadas');
    }

}
