<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Empresa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['Empresa_Nombre',
                            'Empresa_Descripcion',
                            'Empresa_Logo',
                            'Empresa_Email',
                            'Empresa_Direccion',
                            'Empresa_Propietario',
                            'Empresa_Nit',
                            'Empresa_Telefono'];
}
