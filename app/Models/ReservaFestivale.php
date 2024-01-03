<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ReservaFestivale extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['festivale_id',
                            'mesa_festivale_id',
                            'user_id',
                            'Nombre_reserva',
                            'Celular_reserva',
                            'Hora_reserva',
                            'Fecha_registro',
                            'Cantidad_persona',
                            'Adeltanto_reserva',
                            'Deuda_reserva',
                            'Total_reserva',
                            'tipopago',
                            'estado',
                            'total',
                            'Fecha_conclusion',
                            'preventa'];

    //Relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos inversa
    public function festival(){
        return $this->belongsTo(Festivale::class);
    }     
    
    //Relacion de uno a muchos
    public function detallefestivales(){
        return $this->hasMany(DetalleFestivale::class);
    }

    //Relacion de uno a muchos inversa
    public function mesa(){
        return $this->belongsTo(MesaFestivale::class);
    }
}