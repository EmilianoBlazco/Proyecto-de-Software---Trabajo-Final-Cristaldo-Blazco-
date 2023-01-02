<?php
//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//
//class PublicacionTipoInquilino extends Model
//{
//    use HasFactory;
//
//    protected $table = 'publicacion_tipo_inquilino';
//
//    protected $fillable = [
//        'id_publicacion',
//        'id_tipo_inquilino',
//    ];
//
//    //muchas PublicacionTipoInquilino a una Publicacion
//    public function publicacion()
//    {
//        return $this->belongsTo(Publicacion::class, 'id_publicacion');
//    }
//
//    //muchas PublicacionTipoInquilino a una TipoInquilino
//    public function tipoInquilino()
//    {
//        return $this->belongsTo(TipoInquilino::class, 'id_tipo_inquilino');
//    }
//}
