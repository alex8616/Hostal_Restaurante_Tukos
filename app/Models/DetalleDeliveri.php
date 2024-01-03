<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleDeliveri extends Model
{
    use HasFactory;
    protected $fillable = ['deliveri_id',
                           'comanda_id',
                           'estado'];

    //Relacion de uno a muchos inversa
    public function Comanda(){
        return $this->belongsTo(Comanda::class);
    }

    //Relacion de uno a muchos inversa
    public function deliveri(){
        return $this->belongsTo(Deliveri::class);
    }                         
}
