<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Models\Audit;
use Yajra\DataTables\Facades\DataTables;

class AuditoriaController extends Controller
{
    public function index(){
        $pin = '8616833';
        return view('auditoria.log')->with('pin', $pin);
    }

    public function auditsData(){
        $audits = Audit::with('user')->orderBy('created_at', 'desc')->get();

        // Obtener el número total de registros
        $totalRecords = $audits->count();

        // Devolver los resultados en formato JSON
        return DataTables::of($audits)
            ->addIndexColumn()
            ->addColumn('user.name', function ($audit) {
                return $audit->user->name;
            })
            ->addColumn('action', function ($audit) {
                // Agregar aquí cualquier columna adicional que necesites
                // ...

                return '';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
