<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ReservaHabitacionInvitado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['reserva_habitacion_id',
                            'invitado_ingreso_reserva',
                            'invitado_salida_reserva',
                            'invitado_Total',
                            'Pagado'];

    //Relacion de uno a muchos
    public function detallereservainvitados(){
        return $this->hasMany(DetalleReservaInvitado::class);
    }

    //Relacion de uno a muchos inversa
    public function reservahabitacion(){
        return $this->belongsTo(ReservaHabitacion::class);
    }
}
