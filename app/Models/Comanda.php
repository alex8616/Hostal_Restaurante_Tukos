<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;
    protected $fillable = ['tipo_cliente_id',
                           'cliente_id',
                           'user_id',
                           'fecha_venta',
                           'total',
                           'estado',];

    //Relacion de uno a muchos inversa
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    //Relacion de uno a muchos inversa
    public function tipocliente(){
        return $this->belongsTo(TipoCliente::class);
    }

    //Relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos
    public function detallecomandas(){
        return $this->hasMany(DetalleComanda::class);
    }

    //Relacion de uno a muchos
    public function facturaventas(){
        return $this->hasMany(FacturaVenta::class);
    }

    //Relacion de uno a muchos
    public function detalledeliveri(){
        return $this->hasMany(DetalleDeliveri::class);
    }

}
