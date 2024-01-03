<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DetalleReservaHabitacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['reserva_habitacion_id',
                           'cliente_id'];

    //Relacion de uno a muchos inversa
    public function reservahabitacion(){
        return $this->belongsTo(ReservaHabitacion::class);
    }
}
