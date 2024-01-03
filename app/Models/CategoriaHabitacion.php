<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CategoriaHabitacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['Nombre_categoria',
                           'Descripcion_categoria'];

    //Relacion de uno a muchos
    public function habitaciones(){
        return $this->hasMany(Habitacion::class);
    }
}