<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitud';

    protected $fillable = [
        'estado_solicitud',
    ];

    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'id_publicacion');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

}
