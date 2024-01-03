<?php

namespace App\Exports;

use App\Models\ArticuloCaja;
use App\Models\CodigoCaja;
use App\Models\DetalleCaja;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Caja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class CajaExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $caja;

    public function __construct(String $caja, String $total) {

        $this->caja = $caja;
        $this->total = $total;        
    }

    public function view(): View{
        return view('admin.caja.excel_caja',[
            'codigos' => CodigoCaja::get(),
            'articulos' => ArticuloCaja::get(),
            'detallecajas' => DetalleCaja::select('*')
            ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
            ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
            ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
            ->where('detalle_cajas.caja_id', '=', $this->caja)->orderBy('detalle_cajas.id', 'desc')->get(),

            'detalleIngreso' => DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $this->caja)
            ->sum('Ingreso'),
            'detalleEgreso' => DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $this->caja)
            ->sum('Egreso'),
            'total' => $this->total,
        ]);
    }
}
