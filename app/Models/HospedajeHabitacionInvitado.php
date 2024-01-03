<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class HospedajeHabitacionInvitado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['hospedaje_habitacion_id',
                            'invitado_ingreso_hospedaje',
                            'invitado_salida_hospedaje',
                            'invitado_Total',
                            'Pagado'];

    //Relacion de uno a muchos
    public function detallehospedajeinvitados(){
        return $this->hasMany(DetalleHospedajeInvitado::class);
    }

    //Relacion de uno a muchos inversa
    public function hospedajehabitacion(){
        return $this->belongsTo(HospedajeHabitacion::class);
    }
}
