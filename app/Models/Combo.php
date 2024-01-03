<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Combo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['estado',
                           'Nombre_combo',
                           'Detalle_combo',
                           'Precio_combo',
                           'festival_id'];

    //Relacion de uno a muchos
    public function detallefestival(){
        return $this->hasMany(detallefestival::class);
    }                      
}
