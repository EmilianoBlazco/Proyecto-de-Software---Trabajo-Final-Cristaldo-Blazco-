<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
class Provincia extends Model
{
	use SoftDeletes;
	protected $table = 'provincia';

	protected $fillable = [
		'nombre_provincia'
	];

	public function publicacion()
	{
		return $this->hasMany(Publicacion::class, 'id_provincia');
	}
}