<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ClienteHostal extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['Nombre_cliente',
                           'Apellido_cliente',
                           'Documento_cliente',
                           'Nacionalidad_cliente',
                           'Profesion_cliente',
                           'Edad_cliente',
                           'EstadoCivil_cliente',
                           'Celular_cliente',
                           'imagenes'];

    //Relacion uno a muchos
    public function reseva_habitaciones(){
        return $this->hasMany(ReservaHabitacion::class);
    } 

    //Relacion uno a muchos
    public function detalle_hospedaje_habitaciones(){
        return $this->hasMany(DetalleHospedajeHabitacion::class);
    } 
}