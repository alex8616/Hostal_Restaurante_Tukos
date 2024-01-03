<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DetalleReservaInvitado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['reserva_habitacion_invitado_id',
                            'cliente_id'];

    //Relacion de uno a muchos inversa
    public function reservahabitacioninvitado(){
        return $this->belongsTo(ReservaHabitacionInvitado::class);
    }
}
