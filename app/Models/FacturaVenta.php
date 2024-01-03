<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaVenta extends Model
{
    use HasFactory;
    protected $dates = ['fecha_Emision'];
    protected $fillable = ['comanda_id',
                            'codigo_venta_id',
                            'codigo_Control',
                            'QR',
                            'numFactura',
                            'fecha_Emision',
                            'fecha_limite'];
    
    //Relacion de uno a muchos inversa
    public function Comanda(){
        return $this->belongsTo(Comanda::class);
    }
    //Relacion de uno a muchos inversa
    public function codigoventa(){
        return $this->belongsTo(CodigoVenta::class);
    }
}
