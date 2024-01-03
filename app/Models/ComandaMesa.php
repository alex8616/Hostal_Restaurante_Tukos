<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ComandaMesa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['pensionado_id','mesa_id','user_id','fecha_venta','total','estado','tipo_registro'];

    //Relacion de uno a muchos inversa
    public function mesa(){
        return $this->belongsTo(Mesa::class);
    }

    //Relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos
    public function detallecomandamesas(){
        return $this->hasMany(DetalleComandaMesa::class);
    }
}