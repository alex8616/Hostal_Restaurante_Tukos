<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

class ProductoHostal extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['Nombre_producto',
                           'Detalle_producto',
                           'Precio_producto',
                           'Stock_producto',
                           'Estado_producto',
                           'FechaRegistro_producto',
                           'ActualizarStock_producto',
                           'Categoria'];


    //Relacion de uno a muchos
    public function detalleproductos(){
        return $this->hasMany(DetalleProducto::class, 'producto_id');
    }

    //Relacion de uno a muchos
    public function actualizarstocks(){
        return $this->hasMany(UpdateStock::class, 'producto_id');
    }
}
