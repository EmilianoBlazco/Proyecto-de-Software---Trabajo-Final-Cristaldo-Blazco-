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
 * Class TipoPropiedad
 *
 * @property int $id
 * @property string $nombre_tipo_propiedad
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Publicacion[] $publicaciones
 *
 * @package App\Models
 */
class TipoPropiedad extends Model implements Auditable
{
	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
	protected $table = 'tipo_propiedad';

	protected $fillable = [
		'nombre_tipo_propiedad'
	];

	public function publicacion()
	{
		return $this->hasMany(Publicacion::class, 'id_tipo_propiedad');
	}

    public function caracteristica_esperada()
    {
        return $this->belongsToMany(CaracteristicaEsperada::class, 'tipo_propiedad_respuesta', 'id_tipo_propiedad', 'id_caracteriticas_esperadas');
    }
}
