<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DetalleHospedajeHabitacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['hospedaje_habitacion_id',
                           'cliente_id'];
     
    //Relacion de uno a muchos inversa
    public function hospedajehabitacion(){
        return $this->belongsTo(HospedajeHabitacion::class);
    }
}
