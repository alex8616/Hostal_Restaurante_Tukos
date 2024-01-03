<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Menu extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = ['user_id','fecha_registro'];

    //Relacion de uno a muchos
    public function detallemenus(){
        return $this->hasMany(DetalleMenu::class);
    }

    //Relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
}
