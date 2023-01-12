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
 * Class Ciudad
 *
 * @property int $id
 * @property string $nombre_ciudad
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Publicacion[] $publicaciones
 *
 * @package App\Models
 */
class Ciudad extends Model implements Auditable
{
	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
	protected $table = 'ciudad';

	protected $fillable = [
		'nombre_ciudad'
	];

	public function publicacion()
	{
		return $this->hasMany(Publicacion::class, 'id_ciudad');
	}

    //una ciudad a una provincia
    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'id_provincia');
    }

    public function datos_extra()
    {
        return $this->hasMany(Publicacion::class, 'id_ciudad');
    }
}
