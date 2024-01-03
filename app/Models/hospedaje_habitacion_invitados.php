<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class hospedaje_habitacion_invitados extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
}
