<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Publicacion
 *
 * @property int $id
 * @property string|null $estado_publicacion
 * @property string|null $calle_publicacion
 * @property int|null $altura_publicacion
 * @property int|null $dormitorios_publicacion
 * @property int|null $banios_publicacion
 * @property int|null $cochera_publicacion
 * @property int|null $ambientes_publicacion
 * @property float|null $superficie_cubierta_casa
 * @property string|null $imagen_uno_publicacion
 * @property string|null $imagen_dos_publicacion
 * @property string|null $imagen_tres_publicacion
 * @property float|null $superficie_total_terreno
 * @property float|null $precio_publicacion
 * @property string|null $titulo_publicacion
 * @property string|null $descripcion_publicacion
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $id_usuario
 * @property int|null $id_tipo_propiedad
 * @property int|null $id_provincia
 * @property int|null $id_ciudad
 *
 * @property Ciudad|null $ciudad
 * @property Provincia|null $provincium
 * @property TipoPropiedad|null $tipo_propiedad
 * @property User|null $user
 *
 * @package App\Models
 */
class Publicacion extends Model implements Auditable
{
	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;


    protected $table = 'publicacion';

	protected $casts = [
		'altura_publicacion' => 'int',
		'dormitorios_publicacion' => 'int',
		'banios_publicacion' => 'int',
		'cochera_publicacion' => 'int',
		'ambientes_publicacion' => 'int',
		'superficie_cubierta_casa' => 'float',
		'superficie_total_terreno' => 'float',
		'precio_publicacion' => 'float',
		'id_usuario' => 'int',
		'id_tipo_propiedad' => 'int',
		'id_provincia' => 'int',
		'id_ciudad' => 'int',

	];

	protected $fillable = [
		'estado_publicacion',
		'calle_publicacion',
		'altura_publicacion',
		'dormitorios_publicacion',
		'banios_publicacion',
		'cochera_publicacion',
		'ambientes_publicacion',
		'superficie_cubierta_casa',
		'imagen_uno_publicacion',
		'imagen_dos_publicacion',
		'imagen_tres_publicacion',
		'superficie_total_terreno',
		'precio_publicacion',
		'titulo_publicacion',
		'descripcion_publicacion',
		'id_usuario',
		'id_tipo_propiedad',
		'id_provincia',
		'id_ciudad',
        'longitud_publicacion',
        'latitud_publicacion',

	];

	public function ciudad()
	{
		return $this->belongsTo(Ciudad::class, 'id_ciudad');
	}

	public function provincia()
	{
		return $this->belongsTo(Provincia::class, 'id_provincia');
	}

	public function tipo_propiedad()
	{
		return $this->belongsTo(TipoPropiedad::class, 'id_tipo_propiedad');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_usuario');
	}

//    muchos a muchos con CaraacteristicaComodidad
    public function caracteristica_comodidades()
    {
        return $this->belongsToMany(CaracteristicaComodidad::class, 'caracteristica_comodidad_publicacion', 'id_publicacion', 'id_caracteristica');
    }

    //uno a muchos imagen
    public function Image()
    {
        return $this->hasMany(Imagen::class, 'id_publicacion');
    }

    //uno a muchos comentarios
//    public function Comentario()
//    {
//        return $this->hasMany(Comentario::class, 'id_publicacion')->whereNull('id_comentario_padre');
//    }
//
//    //uno a muchos calificaciones
//    public function Calificacion()
//    {
//        return $this->hasMany(Calificacion::class, 'id_publicacion');
//    }

//uno a muchos rating

    public function Rating()
    {
        return $this->hasMany(Rating::class, 'id_publicion');
    }

//    public function CalificacionComentario()
//    {
//        return $this->hasMany(CalificacionComentario::class, 'id_publicacion');
//    }


    //muchos publicaciones a muchos publicacion_tipo_inquilino
    public function publicacion_tipo_inquilino()
    {
        return $this->belongsToMany(TipoInquilino::class, 'publicacion_tipo_inquilino', 'id_publicacion', 'id_tipo_inquilino');
    }
//    public function PublicacionTipoInquilino()
//    {
//        return $this->belongsToMany(PublicacionTipoInquilino::class, 'id_publicion');
//    }

    //union con tabla solicitud
    public function Solicitud()
    {
        return $this->hasMany(Solicitud::class, 'id_publicacion');
    }

}
