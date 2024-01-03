<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DetalleReserva extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['reserva_id',
                            'descripcion_refrigerio',
                            'cantidad_refrigerio',
                            'precio_refrigerio',
                            'monto_refrigerio'];
    //Relacion de uno a muchos inversa
    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }
}