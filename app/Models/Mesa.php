<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Mesa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['Nombre_mesa'];
    
    //Relacion uno a muchos
    public function comandamesas(){
        return $this->hasMany(ComandaMesa::class);
    } 

}
