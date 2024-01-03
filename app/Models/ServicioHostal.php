<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ServicioHostal extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['Nombre_servicio'];

    //Relacion de uno a muchos
    public function detalleserviciohostals(){
        return $this->hasMany(DetalleServicioHostal::class);
    }
}

/*
    $table->string('');
    $table->string('');
*/