<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class RegistroFestivale extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['festivale_id',
                            'mesa_id',
                            'user_id',
                            'fecha_venta',
                            'total'];

    //Relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos inversa
    public function festival(){
        return $this->belongsTo(Festivale::class);
    }     
    
    //Relacion de uno a muchos
    public function detallefestivales(){
        return $this->hasMany(DetalleFestivale::class);
    }

    //Relacion de uno a muchos inversa
    public function mesa(){
        return $this->belongsTo(MesaFestivale::class);
    }
}
