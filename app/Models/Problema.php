<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Problema extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['user_id',
                           'titulo',
                           'description',
                           'asignado_fecha',
                           'resuelto_fecha',
                           'estado',
                           'tipoproblema'];

    //Relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
}

