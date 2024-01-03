<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ReservaHabitacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['ingreso_reserva',
                            'salida_reserva',
                            'procedencia_reserva',
                            'destino_reserva',
                            'dias_reserva',
                            'Precio_habitacion_reserva',
                            'TotalHospedaje_reserva',
                            'PrecioRestante_reserva',
                            'Adelanto_reserva',
                            'Total_reserva',
                            'Estado_reserva',
                            'user_id',
                            'habitacion_id',
                            'TotalProducto_reserva',
                            'TotalServicio_reserva',
                            'EliminadoIngreso',
                            'EliminadoSalida',
                            'TotalGeneralHospedaje_reserva',
                            'CategoriaHabitacion_reserva',
                            'CamaraHotelera'];
                            
    //Relacion de uno a muchos inversa
    public function clientehostal(){
        return $this->belongsTo(ClienteHostal::class);
    }

    //Relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos inversa
    public function habitacion(){
        return $this->belongsTo(Habitacion::class);
    }

    //Relacion de uno a muchos
    public function detallereservas(){
        return $this->hasMany(DetalleReservaHabitacion::class);
    }
    
    //Relacion de uno a muchos
    public function reservahabitacioninvitados(){
        return $this->hasMany(ReservaHabitacionInvitado::class);
    }

    //Relacion de uno a muchos
    public function detalleproductoreservas(){
        return $this->hasMany(DetalleProducto::class);
    }

    //Relacion de uno a muchos
    public function detalleserviciohostals(){
        return $this->hasMany(DetalleServicioHostal::class);
    }
}