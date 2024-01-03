<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DetalleClientes extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = ['tipo_cliente_id',
                           'cliente_id'];

    //Relacion de uno a muchos inversa
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    //Relacion de uno a muchos inversa
    public function tipocliente(){
        return $this->belongsTo(TipoCliente::class);
    }
}
