<?php

namespace App\Models;
use App\Models\Reserva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Ambiente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = ['Nombre_Ambiente'];

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }
}
