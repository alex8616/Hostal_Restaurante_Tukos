<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Articulo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['Nombre_articulo', 'Descripcion_articulo', 'Total_articulo','Buen_Estado','Mal_Estado','Daniado_Estado','photos_articulo'];

    //Relacion de uno a muchos
    public function articulodetalles(){
        return $this->hasMany(ArticuloDetalle::class);
    }
}
