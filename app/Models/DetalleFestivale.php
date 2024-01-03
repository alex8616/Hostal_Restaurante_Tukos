<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DetalleFestivale extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['registrofestival_id',
                            'reservafestival_id',
                            'combo_id',
                            'cantidad',
                            'precio_venta',
                            'descuento',
                            'comentario'];
    
    //Relacion de uno a muchos inversa
    public function Registrofestival(){
        return $this->belongsTo(Registrofestivale::class);
    }

    //Relacion de uno a muchos inversa
    public function reservafestival(){
        return $this->belongsTo(ReservaFestivale::class);
    }

    //Relacion de uno a muchos inversa
    public function combo(){
        return $this->belongsTo(Combo::class);
    }                            

}
