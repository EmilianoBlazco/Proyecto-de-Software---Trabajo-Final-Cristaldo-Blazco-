<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'rating';

//    protected $casts = [
//        'id_usuario' => 'int',
//        'id_publicacion' => 'int'
//    ];

    protected $fillable = [
        'id_usuario',
        'id_publicacion',
        'rating',
        'comentario'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'id_publicacion');
    }
}
