<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DetalleCaja extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = ['caja_id',
                           'codigo_caja_id',
                           'articulo_caja_id',
                           'Articulo_description',
                           'Ingreso',
                           'Egreso',
                           'Fecha_registro',
                           'Factura',
                           'NFactura',
                           'Deuda'];
    
    //Relacion de uno a muchos inversa
    public function caja(){
        return $this->belongsTo(Caja::class);
    }

    //Relacion de uno a muchos inversa
    public function codigocaja(){
        return $this->belongsTo(CodigoCaja::class);
    }

    //Relacion de uno a muchos inversa
    public function articulocaja(){
        return $this->belongsTo(ArticuloCaja::class);
    }
}