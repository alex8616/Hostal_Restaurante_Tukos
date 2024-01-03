<?php

namespace App\Models;
use App\User;
use App\Models\Ambiente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Reserva extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = ['fecha',
                            'hora_inicio',
                            'hora_fin',
                            'motivo',
                            'precio',
                            'adelanto',
                            'deuda_pagar',
                            'ambiente_id',
                            'user_id',
                            'total',
                            'cliente',];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ambiente(){
        return $this->belongsTo(Ambiente::class);
    }

    //Relacion de uno a muchos
    public function detallereservas(){
        return $this->hasMany(DetalleReserva::class);
    }
}