<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Models\Mesa;
use App\Models\Plato;
use App\Models\Comanda;
use App\Models\ComandaMesa;
use App\Models\DetalleComanda;
use App\Models\DetalleComandaMesa;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class BarController extends Controller
{
    public function index(){
        $mesas = Mesa::get();
        $comandaMesa = ComandaMesa::where('tipo_registro', 'BAR')->where('total', '>', 0)->get();
        $detalles = DetalleComandaMesa::get();
        //return response()->json($comandaMesa);
        return view('admin.Bar.index',compact('mesas','comandaMesa','detalles'));
    }

    public function guardarPosiciones(Request $request){
        /*$mesas = $request->input('mesas');
        foreach ($mesas as $mesaData) {
            $mesa = Mesa::find($mesaData['id']);

            if ($mesa) {
                $mesa->posicion_x = $mesaData['posicion_x'];
                $mesa->posicion_y = $mesaData['posicion_y'];
                $mesa->save();
            }
        }
        return response()->json(['mesas' => $mesas]);
    }*/
    $posiciones = $request->input('posiciones');

        foreach ($posiciones as $posicion) {
            $mesa = Mesa::find($posicion['id']);
            if ($mesa) {
                $mesa->posicion_x = $posicion['left'];
                $mesa->posicion_y = $posicion['top'];
                $mesa->save();
            }
        }

        return response()->json(['success' => true]);
    }

    public function consumir($id){
        $mesa = Mesa::FindOrFail($id);
        $mesa->estado = "TRUE";
        $mesa->save();
        $user = Auth::user();
        $comanda = ComandaMesa::create([
            'mesa_id' => $mesa->id,
            'user_id' => Auth::user()->id,
            'fecha_venta' => Carbon::now('America/La_Paz'),
            'tipo_registro' => 'BAR'
        ]); 
        $IdComanda = $comanda->id;
        $platos = Plato::where('platos.categoria_id', '6')->get();
        $bebidas = Plato::where('platos.categoria_id', '9')->get();
        $ultimoRegistro = ComandaMesa::with('detallecomandamesas')->where('mesa_id', $id)->latest()->first();
        return redirect()->route('bar.waitfood',$id);
    }

    public function waitfood($id){
        $allplatos = Plato::get();
        $platos = Plato::where('platos.categoria_id', '6')->get();
        $bebidas = Plato::where('platos.categoria_id', '9')->get();
        $ultimoRegistro = ComandaMesa::with('detallecomandamesas')->where('mesa_id', $id)->latest()->first();
        $IdComanda = $ultimoRegistro->id;
        $totalsum = DetalleComandaMesa::selectRaw('SUM(cantidad * precio_venta) as total')->where('comanda_mesa_id', $IdComanda)->value('total');
        //return response()->json($totalsum);
        return view('admin.Bar.consumir',compact('id','platos','bebidas','ultimoRegistro','IdComanda','allplatos','totalsum'));
    }

    public function concluirventa(Request $request){
        $mesa = Mesa::FindOrFail($request->idmesa);
        $mesa->estado = "FALSE";
        $mesa->save();
        $comanda = ComandaMesa::FindOrFail($request->idcomanda);
        $totalsum = DetalleComandaMesa::selectRaw('SUM(cantidad * precio_venta) as total')->where('comanda_mesa_id', $comanda->id)->value('total');
        $comanda->total = $totalsum;
        $comanda->save();
        return redirect()->route('admin.bar.index');

    }

    public function ventasbar(Request $request){
        $ventas = $request->json()->all();
        
        $total = 0;
        foreach ($ventas['ventas'] as $ventaData) {
            // Crear una nueva instancia de DetalleComandaMesa y asignar los valores
            $detallecomanda = DetalleComandaMesa::create([
                'comanda_mesa_id' => $request->IdComanda,
                'plato_id' => $ventaData['id'],
                'cantidad' => $ventaData['cantidad'],
                'precio_venta' => $ventaData['precio'],
            ]);
        
            $total += $ventaData['total'];
        }
        // Retornar una respuesta adecuada (por ejemplo, un mensaje de éxito)
        return response()->json(['message' => 'Ventas registradas correctamente']);
    }

    public function pdf(ComandaMesa $listacomanda){
        //return response()->json($listacomanda);
        $detallecomandas = DetalleComandaMesa::get();
        $pdf = PDF::loadView('admin.Bar.pdf', compact('listacomanda','detallecomandas'))->setOptions(['defaultFont' => 'sans-serif'])->setPaper(array(0,0,320,500), 'portrait');;
        return $pdf->stream('Reporte_de_venta'.$listacomanda->id.'pdf');
    }
}
