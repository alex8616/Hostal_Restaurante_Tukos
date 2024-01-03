<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoVenta extends Model
{
    use HasFactory;
    protected $fillable = ['autorizacion',
                            'clave',
                            'fecInicio',
                            'fecFinal'];

    //Relacion uno a muchos
    public function facturaventa(){
        return $this->hasMany(FacturaVenta::class);
    } 
}
