<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MesaFestivale extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = ['festivale_id',
                            'Nombre_mesa',
                            'posicion_x',
                            'posicion_y',
                            'estado'];

    //Relacion uno a muchos
    public function registrofestivales(){
        return $this->hasMany(RegistroFestivale::class);
    }
    
    //Relacion uno a muchos
    public function reservafestivales(){
        return $this->hasMany(ReservaFestivale::class);
    }

}
