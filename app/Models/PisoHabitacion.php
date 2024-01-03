<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PisoHabitacion extends Model
{
    use HasFactory;
    protected $fillable = ['Nombre_piso'];

    //Relacion de uno a muchos
    public function habitaciones(){
        return $this->hasMany(Habitacion::class);
    }
}
