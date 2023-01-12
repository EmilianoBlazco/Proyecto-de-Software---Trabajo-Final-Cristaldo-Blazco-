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
 * Class Provincia
 *
 * @property int $id
 * @property string $nombre_provincia
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Publicacion[] $publicaciones
 *
 * @package App\Models
 */
class Provincia extends Model implements Auditable
{
	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
	protected $table = 'provincia';

	protected $fillable = [
		'nombre_provincia'
	];

    //una provincia muchas ciudades
    public function ciudades()
    {
        return $this->hasMany(Ciudad::class, 'id_provincia');
    }
}
