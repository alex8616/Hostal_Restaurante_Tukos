<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DetalleServicioHostal extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['hospedaje_habitacion_id',
                            'reserva_habitacion_id',
                            'user_id',
                            'servicio_hostals_id',
                            'cantidad_servicio',
                            'Precio_servicio',
                            'FechaRegistro_servicio',
                            'Incluye_servicio',
                            'detalle'];
    
    //Relacion de uno a muchos inversa
    public function hospedajehabitacion(){
        return $this->belongsTo(HospedajeHabitacion::class);
    }

    //Relacion de uno a muchos inversa
    public function reservahabitacion(){
        return $this->belongsTo(ReservaHabitacion::class);
    }
}
