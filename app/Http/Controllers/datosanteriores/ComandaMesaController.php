<?php

namespace App\Http\Controllers;

use App\Models\ComandaMesa;
use Illuminate\Http\Request;
use App\Models\DetalleComandaMesa;
use App\Http\Requests\Comanda\StoreRequest;
use App\Models\Comanda;
use App\Models\DetalleComanda;
use App\Models\DetalleMenu;
use App\Models\Cliente;
use App\Models\Plato;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Mesa;
use Barryvdh\DomPDF\Facade\Pdf;

class ComandaMesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $comandamesas = ComandaMesa::orderBy('id', 'desc')->get();
        $detallecomandamesas = DetalleComandaMesa::orderBy('id', 'desc')->get();
        return view ('admin.comandamesa.index', compact('comandamesas','detallecomandamesas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function pdf(ComandaMesa $comandaMesa){

        $subtotal = 0;
        $detallecomandamesas = $comandaMesa->detallecomandamesas;
        foreach ($detallecomandamesas as $detallecomandamesa) {
                $subtotal += $detallecomandamesa->cantidad *
                $detallecomandamesa->precio_venta - $detallecomandamesa->cantidad *
                $detallecomandamesa->precio_venta * $detallecomandamesa->descuento / 100;
        }  

        $pdf = PDF::loadView('admin.comandamesa.pdf', compact('comandaMesa', 'subtotal', 'detallecomandamesas'))
                    ->setOptions(['defaultFont' => 'sans-serif'])->setPaper(array(0,0,320,500), 'portrait');;
        return $pdf->stream('Reporte_de_venta'.$comandaMesa->id.'pdf');
        
    }

    public function show(ComandaMesa $comandamesa){

        $subtotal = 0;
        $detallecomandamesas = $comandamesa->detallecomandamesas;
        foreach ($detallecomandamesas as $detallecomandamesa) {
            $subtotal += $detallecomandamesa->cantidad *
            $detallecomandamesa->precio_venta - $detallecomandamesa->cantidad *
            $detallecomandamesa->precio_venta;
        }
       // return response()->json($comandamesa);
        return view('admin.mesa.show', compact('comandamesa', 'detallecomandamesas', 'subtotal'));
    }

    public function ReporteMesasDiario(Request $request){
        $InputStart = $request->PedidosDiarioStart;
        $HoraInicio = Carbon::parse($InputStart)->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        $HoraFin = Carbon::parse($InputStart)->setTime(23, 59, 00)->format('Y-m-d H:i:s');

        $data = [];
        
        $data = ComandaMesa::select('comanda_mesas.*','mesas.Nombre_mesa')
            ->join('mesas','mesas.id','comanda_mesas.mesa_id')
            ->join('detalle_comanda_mesas', 'detalle_comanda_mesas.comanda_mesa_id', '=', 'comanda_mesas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comanda_mesas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [2, 3, 4, 5])
            ->whereBetween('comanda_mesas.fecha_venta', [$HoraInicio, $HoraFin])
            ->groupBy('comanda_mesas.id')
            ->get();

        
        $detallecomandas = DetalleComandaMesa::select('*')
            ->join('platos', 'platos.id', '=', 'detalle_comanda_mesas.plato_id')
            ->get();    


        //return response()->json($data);
        $pdf = PDF::loadView('admin.comandamesa.ReporteMesasDiarioPDF', compact('detallecomandas','data','InputStart'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }
    
    public function ReporteMesasMes(Request $request){
        $Month = $request->get('monthID');

        $data = [];
        
        $data = ComandaMesa::select('comanda_mesas.*','mesas.Nombre_mesa')
            ->join('mesas','mesas.id','comanda_mesas.mesa_id')
            ->join('detalle_comanda_mesas', 'detalle_comanda_mesas.comanda_mesa_id', '=', 'comanda_mesas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comanda_mesas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [2, 3, 4, 5])
            ->where(DB::raw("(DATE_FORMAT(comanda_mesas.fecha_venta,'%Y-%m'))"), "=", $Month)
            ->groupBy('comanda_mesas.id')
            ->get();
        
        $detallecomandas = DetalleComandaMesa::select('*')
            ->join('platos', 'platos.id', '=', 'detalle_comanda_mesas.plato_id')
            ->get();    

        //return response()->json($data);
        $pdf = PDF::loadView('admin.comandamesa.ReporteMesasMesPDF', compact('detallecomandas','data','Month'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReporteMesasRangeFecha(Request $request){
        $desde = $request->get('PedidosInicioDate');
        $hasta = $request->get('PedidosFinalDate');

        $desdeIniciar = Carbon::parse($desde)->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        $hastaConcluir = Carbon::parse($hasta)->setTime(23, 59, 00)->format('Y-m-d H:i:s');

        $data = [];
        
        $data = ComandaMesa::select('comanda_mesas.*','mesas.Nombre_mesa')
            ->join('mesas','mesas.id','comanda_mesas.mesa_id')
            ->join('detalle_comanda_mesas', 'detalle_comanda_mesas.comanda_mesa_id', '=', 'comanda_mesas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comanda_mesas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [2, 3, 4, 5])
            ->whereBetween('comanda_mesas.fecha_venta', [$desdeIniciar, $hastaConcluir])
            ->groupBy('comanda_mesas.id')
            ->get();
        
        $detallecomandas = DetalleComandaMesa::select('*')
            ->join('platos', 'platos.id', '=', 'detalle_comanda_mesas.plato_id')
            ->get(); 
        //return response()->json($data);
        $pdf = PDF::loadView('admin.comandamesa.ReporteMesasRangeFechaPDF', compact('detallecomandas','data','desde','hasta'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }
}
