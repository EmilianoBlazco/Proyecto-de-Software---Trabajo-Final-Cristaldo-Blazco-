<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaracteristicaEsperada extends Model
{
    use HasFactory;

    protected $table = 'caracteriticas_esperadas';

    protected $fillable = [
        'Estado_respuesta',
        'calle_respuesta_1',
        'calle_respuesta_2',
        'calle_respuesta_3',
        'ambientes_respuesta',
        'dormitorios_respuesta',
        'banios_respuesta',
        'cochera_respuesta',
        'precio_respuesta_minimo',
        'precio_respuesta_maximo',
        'id_usuario',
        'id_tipo_propiedad',
        'id_tipo_inquilino',
    ];

    //uno a uno usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
//    public function usuario()
//    {
//        return $this->hasOne(User::class, 'id_usuario');
//    }

    //relacion con caracteristicas_esperadas muchos a muchos con tipo_propiedad
    public function tipo_propiedad()
    {
        return $this->belongsToMany(TipoPropiedad::class, 'tipo_propiedad_respuesta', 'id_caracteriticas_esperadas', 'id_tipo_propiedad');
    }
    //relacion con caracteristicas_esperadas muchos a muchos con tipo_inquilino
    public function tipo_inquilino()
    {
        return $this->belongsToMany(TipoInquilino::class, 'tipo_inquilino_respuesta', 'id_caracteriticas_esperadas', 'id_tipo_inquilino');
    }

    //relacion con caracteristicas_esperadas muchos a muchos con caracteristica_comodidad
    public function caracteristica_comodidad()
    {
        return $this->belongsToMany(CaracteristicaComodidad::class, 'comodidad_respuesta', 'id_caracteriticas_esperadas', 'id_caracteristica_comodidad');
    }



}
