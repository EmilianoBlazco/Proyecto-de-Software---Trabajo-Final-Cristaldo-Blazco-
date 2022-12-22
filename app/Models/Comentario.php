<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentario';

//    protected $casts = [
//        'id_publicacion' => 'int',
//        'id_usuario' => 'int',
//        'id_calificacion' => 'int'
//    ];

    protected $fillable = [
        'comentario',
        'id_publicacion',
        'id_usuario',
        'estado_comentario',
    ];

//    public function calificacion()
//    {
//        return $this->belongsTo(Calificacion::class, 'id_calificacion');
//    }

    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'id_publicacion');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function comentario_padre()
    {
        return $this->belongsTo(Comentario::class, 'id_comentario_padre');
    }

    public function respuestas()
    {
        return $this->hasMany(Comentario::class, 'id_comentario_padre');
    }
}
