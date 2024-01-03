<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ArticuloDetalle extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['articulo_id','fecha_actualizado','datos_anteriores'];

    //Relacion de uno a muchos inversa
    public function articulo(){
        return $this->belongsTo(Articulo::class);
    }
}
