<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CodigoCaja extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = ['Nombre'];

    //Relacion de uno a muchos
    public function detallecajas(){
        return $this->hasMany(DetalleCaja::class);
    }

     //Relacion de uno a muchos
     public function comandas(){
        return $this->hasMany(Comanda::class);
    }
}
