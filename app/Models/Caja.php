<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Caja extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['user_id',
                           'fecha_registro',
                           'caja_hostal_ingreso',
                           'caja_hostal_egreso',
                           'caja_restaurante_ingreso',
                           'caja_restaurante_egreso',
                           'caja_tarjetas_ingreso',
                           'caja_depositos_ingreso',
                           'total'];
    
    //Relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos
    public function detallecajas(){
        return $this->hasMany(DetalleCaja::class);
    }

    //Relacion de uno a muchos
    public function libronovedades(){
        return $this->hasMany(LibroNovedade::class);
    }
  
}
