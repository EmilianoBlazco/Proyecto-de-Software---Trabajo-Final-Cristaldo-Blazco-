<?php
//
///**
// * Created by Reliese Model.
// */
//
//namespace App\Models;
//
//use Carbon\Carbon;
//use Illuminate\Database\Eloquent\Collection;
//use Illuminate\Database\Eloquent\Model;
//
///**
// * Class User
// *
// * @property int $id
// * @property string $name
// * @property string $email
// * @property Carbon|null $email_verified_at
// * @property string $password
// * @property string|null $two_factor_secret
// * @property string|null $two_factor_recovery_codes
// * @property Carbon|null $two_factor_confirmed_at
// * @property string|null $remember_token
// * @property int|null $current_team_id
// * @property string|null $profile_photo_path
// * @property Carbon|null $created_at
// * @property Carbon|null $updated_at
// *
// * @property Collection|Publicacion[] $publicacions
// *
// * @package App\Models
// */
//class User extends Model
//{
//	protected $table = 'users';
//
//	protected $casts = [
//		'current_team_id' => 'int'
//	];
//
//	protected $dates = [
//		'email_verified_at',
//		'two_factor_confirmed_at'
//	];
//
//	protected $hidden = [
//		'password',
//		'two_factor_secret',
//		'remember_token'
//	];
//
//	protected $fillable = [
//		'name',
//		'email',
//		'email_verified_at',
//		'password',
//		'two_factor_secret',
//		'two_factor_recovery_codes',
//		'two_factor_confirmed_at',
//		'remember_token',
//		'current_team_id',
//		'profile_photo_path'
//	];
//
//	public function publicacions()
//	{
//		return $this->hasMany(Publicacion::class, 'id_usuario');
//	}
//}


namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;


class User extends Authenticatable implements Auditable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

//    public function publicacions()
//    {
//        return $this->hasMany(Publicacion::class, 'id_usuario');
//    }

//    public function comentario()
//    {
//        return $this->hasMany(Comentario::class, 'id_usuario');
//    }
//
//    //una a muchos calificaciones
//    public function calificacion()
//    {
//        return $this->hasMany(Calificacion::class, 'id_usuario');
//    }

//uno a muchos rating
    public function rating()
    {
        return $this->hasMany(Rating::class, 'id_usuario');
    }

//uno a muchos calificacion_comentario
//    public function CalificacionComentario()
//    {
//        return $this->hasMany(CalificacionComentario::class, 'id_usuario');
//    }

//uno a muchos solicitud
    public function solicitud()
    {
        return $this->hasMany(Solicitud::class, 'id_usuario');
    }

    //uno a uno encuesta
    public function encuesta()
    {
        return $this->hasOne(Encuesta::class, 'id_usuario');
    }
}
