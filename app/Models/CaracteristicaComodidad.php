<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CaracteristicaComodidad
 *
 * @property int $id
 * @property string $nombre_caracteristica_comodidad
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $id_comodidad
 *
 * @property Comodidad $comodidad
 * @property Collection|Publicacion[] $publicacions
 *
 * @package App\Models
 */
class CaracteristicaComodidad extends Model implements Auditable
{
	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
	protected $table = 'caracteristica_comodidad';

	protected $casts = [
		'id_comodidad' => 'int'
	];

	protected $fillable = [
		'nombre_caracteristica_comodidad',
		'id_comodidad'
	];

	public function comodidad()
	{
		return $this->belongsTo(Comodidad::class, 'id_comodidad');
	}

	public function publicacions()
	{
		return $this->belongsToMany(Publicacion::class, 'caracteristica_comodidad_publicacion', 'id_caracteristica', 'id_publicacion')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

    //relacion con caracteristicas_esperadas muchos a muchos con caracteristica_comodidad
    public function caracteristicaEsperada()
    {
        return $this->belongsToMany(CaracteristicaEsperada::class, 'caracteristica_comodidad_respuesta', 'id_caracteristica_comodidad', 'id_caracteriticas_esperadas');
    }
}
