<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveri extends Model
{
    use HasFactory;
    protected $fillable = ['Observacion',
                           'Fecha_inicio',
                           'Fecha_fin',
                           'Cambio',
                           'concluido'];
    //Relacion de uno a muchos
    public function detalledeliveri(){
        return $this->hasMany(DetalleDeliveri::class);
    }
}
