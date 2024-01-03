<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UpdateStock extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['ActualizarStock',
                            'producto_id',
                            'aumento',
                            'datoanterior1'];
            
    //Relacion de uno a muchos inversa
    public function productohostal(){
        return $this->belongsTo(ProductoHostal::class);
    }
}
