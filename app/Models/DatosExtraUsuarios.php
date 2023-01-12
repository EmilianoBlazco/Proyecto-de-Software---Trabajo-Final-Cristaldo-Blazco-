<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosExtraUsuarios extends Model
{
    use HasFactory;

    protected $table = 'datos_extra_usuarios';

    protected $fillable = [
        'domicilio_calle',
        'domicilio_altura',
        'domicilio_provincia',
        'domicilio_ciudad',
        'dni',
        'cuit',
        'id_usuario'
    ];

    //uno a uno usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    //uno a uno ciudad
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'id_ciudad');
    }
}
