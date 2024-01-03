<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Habitacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['Nombre_habitacion',
                            'Detalle_habitacion',
                            'Precio_habitacion',
                            'imagen',
                            'color_habitacion',
                            'Estado_habitacion',
                            'Reserva_habitacion'];

    //Relacion de uno a muchos
     public function detallehospedajes(){
        return $this->hasMany(DetalleHospedajeHabitacion::class);
    }

    //Relacion de uno a muchos
    public function detallereservas(){
        return $this->hasMany(DetalleReserva::class);
    }
    
    //Relacion de uno a muchos
    public function controlcamarerias(){
        return $this->hasMany(ControlCamareria::class);
    }
}
