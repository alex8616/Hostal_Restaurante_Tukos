<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Festivale extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['nombre_festival',
                            'descripcion_festival',
                            'fecha_festival',
                            'foto_festival'];
    
    //Relacion de uno a muchos
    public function registrofestivales(){
        return $this->hasMany(RegistroFestivale::class);
    }
    
    //Relacion de uno a muchos
    public function reservafestivales(){
        return $this->hasMany(ReservaFestivale::class);
    }
}
