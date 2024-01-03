<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class HospedajeHabitacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['ingreso_hospedaje',
                            'salida_hospedaje',
                            'procedencia_hospedaje',
                            'destino_hospedaje',
                            'dias_hospedarse',
                            'Precio_habitacion',
                            'PrecioRestante',
                            'Adelanto',
                            'Total',
                            'user_id',
                            'habitacion_id',
                            'TotalProducto',
                            'TotalServicio',
                            'TotalGeneralHospedaje',
                            'CategoriaHabitacion',
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
    public function detallehospedajes(){
        return $this->hasMany(DetalleHospedajeHabitacion::class);
    }
    
    //Relacion de uno a muchos
    public function detalleproductos(){
        return $this->hasMany(DetalleProducto::class);
    }

    //Relacion de uno a muchos
    public function detalleserviciohostals(){
        return $this->hasMany(DetalleServicioHostal::class);
    }

    //Relacion de uno a muchos
    public function hospedajehabitacioninvitados(){
        return $this->hasMany(HospedajeHabitacionInvitado::class);
    }
}

