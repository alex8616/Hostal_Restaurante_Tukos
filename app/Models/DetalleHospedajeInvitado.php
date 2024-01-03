<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DetalleHospedajeInvitado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['hospedaje_habitacion_invitado_id',
                            'cliente_id'];

     //Relacion de uno a muchos inversa
     public function hospedajehabitacioninvitado(){
        return $this->belongsTo(HospedajeHabitacionInvitado::class);
    }
}
