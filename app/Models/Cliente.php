<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cliente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['Nit_cliente','Nombre_cliente','Apellidop_cliente',
                            'Direccion_cliente','Celular_cliente',
                            'FechaNacimiento_cliente','Correo_cliente','latidud','longitud'];
    
    //Relacion uno a muchos
    public function comandas(){
        return $this->hasMany(Comanda::class);
    } 

    //Relacion uno a muchos
    public function detalleclientes(){
        return $this->hasMany(DetalleClientes::class);
    } 
}
