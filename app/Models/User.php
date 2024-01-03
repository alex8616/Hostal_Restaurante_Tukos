<?php

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
    use \OwenIt\Auditing\Auditable;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    use HasRoles;

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

    //relacion de uno a muchos
    public function comandas() {
        return $this->hasMany(Comanda::class);
     }

     //relacion de uno a muchos
    public function menus() {
        return $this->hasMany(Menu::class);
     }

    //relacion de uno a muchos
    public function comandamesas() {
        return $this->hasMany(ComandaMesa::class);
     }

     //relacion de uno a muchos
    public function tipoclientes() {
        return $this->hasMany(TipoCliente::class);
     }

     //relacion de uno a muchos
    public function fecha_cajas() {
        return $this->hasMany(FechaCaja::class);
     }
     
    //relacion de uno a muchos
    public function problemas() {
        return $this->hasMany(Problema::class);
     }

    //relacion de uno a muchos
    public function libronovedades() {
        return $this->hasMany(LibroNovedade::class);
     }

     //relacion de uno a muchos
    public function controlcamarerias() {
        return $this->hasMany(ControlCamareria::class);
     }
}
