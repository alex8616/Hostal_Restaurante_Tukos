<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comanda\StoreRequest;
use App\Models\Comanda;
use Illuminate\Http\Request;
use App\Models\DetalleComanda;
use App\Models\Cliente;
use App\Models\Plato;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\TipoCliente;
use App\Models\Categoria;
use Barryvdh\DomPDF\Facade\Pdf;
use Luecano\NumeroALetras\NumeroALetras;
use App\Models\NumToLetter;
use App\Models\Empresa;
use App\Models\ControlCode;
use App\Models\FacturaVenta;
use App\Models\CodigoVenta;
use App\Models\ComandaMesa;
use App\Models\Mesa;
use App\Models\Caja;
use App\Models\DetalleCaja;
use App\Models\DetalleClientes;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use  DateTime;
use DateInterval;
use DatePeriod;

class ComandaController extends Controller
{
    private $numPage;

    public function index(){
        $comandas = Comanda::orderBy('id', 'desc')->paginate(10);
        $detallecomandas = DetalleComanda::orderBy('id', 'desc')->paginate(10);
        $tipoclientes = TipoCliente::get();
        return view ('admin.comanda.index', compact('comandas','detallecomandas','tipoclientes'));
        //return response()->json($tipoclientes);
    }

    public function create(){
        
        $clientes = Cliente::get();
        $platos = Plato::get();
        $comanda = Comanda::latest('id')->first();
        $tipoclientes = TipoCliente::distinct('id')->get();
        $categorias = Categoria::get();
        
        $ultimo_registro = Caja::latest('id')->first();

        //return response()->json($ultimo_registro->id);
        return view('admin.comanda.create', compact('clientes','comanda','platos','tipoclientes','categorias','ultimo_registro'));
    }

    public function facturas(){
        $comandas = Comanda::orderBy('id', 'desc')->get();
        $facturas = FacturaVenta::orderBy('id', 'desc')->get();
        $detallecomandas = DetalleComanda::orderBy('id', 'desc')->get();
        $tipoclientes = TipoCliente::orderBy('id', 'desc')->get();
        return view ('admin.comanda.facturas', compact('comandas','detallecomandas','tipoclientes','facturas'));
        //return response()->json($facturas);
    }

    public function store(Request $request){
        if($request->fact == 0){
            $n=count(FacturaVenta::get())+1;
            try {
                DB::beginTransaction();
                $user = Auth::user(); 
                    foreach($request->id_plato as $key=>$insert){
                        $results[] = array("plato_id" => $request->id_plato[$key],
                                            "cantidad" => $request->cantidad[$key],
                                            "precio_venta" => $request->Precio_plato[$key],
                                            "descuento" => $request->descuento[$key],
                                            "comentario" => $request->comentario[$key]);
                    }

                    $user = Auth::user();
                    $CodigoVenta = CodigoVenta::findOrFail(1);
                    $comanda = Comanda::create($request->all() + [
                        'user_id' => Auth::user()->id,
                        'fecha_venta' => Carbon::now('America/La_Paz'),
                    ]);

                    $pos = strpos($comanda->cliente->Nit_cliente, '-');
                    $nit='';
                    if($pos===false){
                        $nit=$comanda->cliente->Nit_cliente;
                    }else{
                        $pizza  = $comanda->cliente->Nit_cliente;
                        $porciones = explode("-", $pizza);
                        $nit=$porciones[0];
                    }
                    $facturavnt = FacturaVenta::create([
                        $empresas = Empresa::select('*')->where('id', 1)->firstOrFail(),
                        $controlCode = new ControlCode(),
                        $date = Carbon::now(),
                        $date = $date->format('d/m/Y'),
                        $code = $controlCode->generate($CodigoVenta->autorizacion,//Numero de autorizacion -> lo obtendre
                                $n,//Numero de factura
                                $nit,//Número de Identificación Tributaria o Carnet de Identidad 
                                str_replace('/','',$date),//fecha de transaccion de la forma AAAAMMDD
                                $request->total,//Monto de la transacción
                                $CodigoVenta->clave//Llave de dosificación -> lo obtendre
                        ),
                        $rellenar='0|0|0|0',
                        $facturagenerate=$empresas->Empresa_Nit.'|'.$n.'|'.$CodigoVenta->autorizacion.'|'.$date.'|'.$request->total.'|'.$request->total.'|'.$code.'|'.$request->Nit_cliente.'|'.$rellenar,
                        //$qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($facturagenerate)),
                        //$qrcode = QrCode::format('png')->size(200)->generate($facturagenerate,'../public/qrcodes/'.$request->Nit_cliente.'-'.$n.'.'.'png'),
                        //$qrcode = QrCode::format('png')->size(200)->generate($facturagenerate,'../public/qrcodes/'.$request->Nit_cliente.'-'.$n.'.'.'png'),
                        //$qrcode = QrCode::format('svg')->size(200)->generate($facturagenerate,'../public/qrcodes/'.$request->Nit_cliente.'-'.$n.'.'.'svg'),
                        'comanda_id' => $comanda->id,
                        'codigo_venta_id' => 1,
                        'codigo_Control' => $code,
                        'QR' => $facturagenerate,
                        'numFactura' => $n,
                        'fecha_Emision' => Carbon::now('America/La_Paz'),
                        'fecha_limite' => Carbon::now('America/La_Paz')->addMonth(3),
                    ]);
                    $comanda->detallecomandas()->createMany($results);
                 DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar FACTURA y COMANDA', 'No Se Pudo Registrar FACTURA y COMANDA');
                return redirect()->route('admin.comanda.index');
            }
                notify()->success('Se Registro Correctamente FACTURA y COMANDA') or notify()->success('Se Registro Correctamente FACTURA y COMANDA', 'Se Registro Correctamente FACTURA y COMANDA');
                return redirect()->route('admin.comanda.index'); 
        }else{
        try {
            DB::beginTransaction();
            $user = Auth::user(); 
            
                foreach($request->id_plato as $key=>$insert){
                    $results[] = array("plato_id" => $request->id_plato[$key],
                                        "cantidad" => $request->cantidad[$key],
                                        "precio_venta" => $request->Precio_plato[$key],
                                        "descuento" => $request->descuento[$key],
                                        "comentario" => $request->comentario[$key]);
                }

                $user = Auth::user();
                $comanda = Comanda::create($request->all() + [
                    'user_id' => Auth::user()->id,
                    'fecha_venta' => Carbon::now('America/La_Paz'),
                ]);                                

                $comanda->detallecomandas()->createMany($results);

                /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
                $Clientes = Cliente::findOrFail($request->cliente_id);         

                $DetalleCajas = DetalleCaja::create([
                    'caja_id' => $request->caja_id,
                    'codigo_caja_id' => 1,
                    'articulo_caja_id' => 23,
                    'Articulo_description' => 'Almuerzo '.$Clientes->Nombre_cliente.' '.$Clientes->Apellidop_cliente,
                    'Ingreso' => $request->total,
                    'Egreso' => 0.00,
                    'Fecha_registro' => Carbon::now('America/La_Paz'),
                ]);

                $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
                $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
                $resultadohostal = $hostal_ingreso-$hostal_egreso;

                $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
                $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
                $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
                $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
                $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

                $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
                
                $cajas = Caja:: findOrFail($request->caja_id);
                $cajas->caja_hostal_ingreso = $hostal_ingreso;
                $cajas->caja_hostal_egreso = $hostal_egreso;
                $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
                $cajas->caja_restaurante_egreso = $restaurante_egreso;
                $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
                $cajas->total = $totalfinal;
                $cajas->caja_depositos_ingreso = $depositos_ingreso;
                $cajas->save(); 
                /*FIN TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/

                DB::commit();
                    } catch (\Throwable $th) {
                    DB::rollback();
                    notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar COMANDA', 'No Se Pudo Registrar COMANDA');
                    return redirect()->route('admin.comanda.index');
                }
                    notify()->success('Se Registro Correctamente COMANDA') or notify()->success('Se Registro Correctamente COMANDA', 'Se Registro Correctamente COMANDA');
                    return redirect()->route('admin.comanda.index');
            }
        
    }

    public function storepensionado(Request $request){
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $comanda = Comanda::create($request->all() + [
                'user_id' => Auth::user()->id,
                'fecha_venta' => Carbon::now('America/La_Paz'),
            ]);
            foreach($request->id_plato as $key=>$insert){
                $results[] = array("plato_id" => $request->id_plato[$key],
                                    "cantidad" => $request->cantidad[$key],
                                    "precio_venta" => $request->Precio_plato[$key],
                                    "descuento" => $request->descuento[$key],
                                    "comentario" => $request->comentario[$key]);
            }
            $comanda->detallecomandas()->createMany($results);

            /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
            $clientes = TipoCliente::findOrFail($request->tipo_cliente_id);
            $DetalleCajas = DetalleCaja::create([
                'caja_id' => $request->caja_id,
                'codigo_caja_id' => 1,
                'articulo_caja_id' => 23,
                'Articulo_description' => 'Almuerzo a '.$clientes->Nombre_tipoclientes,
                'Ingreso' => $request->total,
                'Egreso' => 0.00,
                'Fecha_registro' => Carbon::now('America/La_Paz'),
            ]);

            $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
            $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
            $resultadohostal = $hostal_ingreso-$hostal_egreso;

            $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
            $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
            $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
            $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
            $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

            $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
            
            $cajas = Caja:: findOrFail($request->caja_id);
            $cajas->caja_hostal_ingreso = $hostal_ingreso;
            $cajas->caja_hostal_egreso = $hostal_egreso;
            $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
            $cajas->caja_restaurante_egreso = $restaurante_egreso;
            $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
            $cajas->total = $totalfinal;
            $cajas->caja_depositos_ingreso = $depositos_ingreso;
            $cajas->save(); 
            /*FIN TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/

            DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ⚡️', 'No Se Pudo Registrar');
            return redirect()->route('admin.comanda.index');
        }
            notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente ⚡️', 'Se Registro Correctamente');
            //return response()->json($request->all());
            return redirect()->route('admin.comanda.index');
    }

    public function storetukomana(Request $request){
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $comanda = Comanda::create($request->all() + [
                'user_id' => Auth::user()->id,
                'fecha_venta' => Carbon::now('America/La_Paz'),
            ]);
            foreach($request->id_plato as $key=>$insert){
                $results[] = array("plato_id" => $request->id_plato[$key],
                                    "cantidad" => $request->cantidad[$key],
                                    "precio_venta" => $request->Precio_plato[$key],
                                    "comentario" => $request->comentario[$key]);
            }
            $comanda->detallecomandas()->createMany($results);

            /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
            $DetalleCajas = DetalleCaja::create([
                'caja_id' => $request->caja_id,
                'codigo_caja_id' => 1,
                'articulo_caja_id' => 5,
                'Articulo_description' => 'TUKUMANAS',
                'Ingreso' => $request->total,
                'Egreso' => 0.00,
                'Fecha_registro' => Carbon::now('America/La_Paz'),
            ]);

            $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
            $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
            $resultadohostal = $hostal_ingreso-$hostal_egreso;

            $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
            $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
            $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
            $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
            $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

            $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
            
            $cajas = Caja:: findOrFail($request->caja_id);
            $cajas->caja_hostal_ingreso = $hostal_ingreso;
            $cajas->caja_hostal_egreso = $hostal_egreso;
            $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
            $cajas->caja_restaurante_egreso = $restaurante_egreso;
            $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
            $cajas->total = $totalfinal;
            $cajas->caja_depositos_ingreso = $depositos_ingreso;
            $cajas->save(); 
            /*FIN TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/

            DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ⚡️', 'No Se Pudo Registrar');
            return redirect()->route('admin.comanda.createtukomana');
        }
            notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente ⚡️', 'Se Registro Correctamente');
            //return response()->json($request->all());
            return redirect()->route('admin.comanda.createtukomana');
    }
    
    public function createpensionado(){

        $clientes = Cliente::get();
        $platos = Plato::get();
        $comanda = Comanda::distinct('id')->get();
        $tipoclientes = TipoCliente::distinct('id')->get();
        $categorias = Categoria::get();

        $ultimo_registro = Caja::latest('id')->first();

        return view('admin.comanda.createpensionado', compact('clientes','comanda','platos','tipoclientes','categorias','ultimo_registro'));
        //return response()->json($comanda);
    }

    public function createtukomana(){

        $clientes = Cliente::get();
        $platos = Plato::select('platos.id','platos.Nombre_plato','platos.Precio_plato',
                                'platos.Caracteristicas_plato','categorias.Nombre_categoria')
                        ->join('categorias','categorias.id','platos.categoria_id')
                        ->where(function ($query) {
                            $query->where('categorias.Nombre_categoria', '=', 'TUKOMANAS')
                                  ->orWhere('categorias.Nombre_categoria', '=', 'Bebidas/Gaseosas/Jugos');
                        })
                        ->get();

        $comanda = Comanda::latest('id')->first();
        $tipoclientes = TipoCliente::distinct('id')->get();
        $categorias = Categoria::get();
        $comandaspdf = Comanda::latest('id')->first();
        $ultimo_registro = Caja::latest('id')->first();
        //return response()->json($platos);
        return view('admin.comanda.createtukomana', compact('clientes','comanda','platos','tipoclientes','categorias','comandaspdf','ultimo_registro'));
        
    }
    
    public function show(Comanda $comanda){

        $subtotal = 0;
        $tipoclientes = Cliente::select('tipo_clientes.Nombre_tipoclientes')
        ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
        ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
        ->where('detalle_clientes.tipo_cliente_id', '=', $comanda->tipo_cliente_id)->get();
        $detallecomandas = $comanda->detallecomandas;
        foreach ($detallecomandas as $detallecomanda) {
            $subtotal += $detallecomanda->cantidad *
            $detallecomanda->precio_venta - $detallecomanda->cantidad *
            $detallecomanda->precio_venta * $detallecomanda->descuento / 100;
        }

        $new = new NumToLetter();
        return view('admin.comanda.show', compact('comanda', 'detallecomandas', 'subtotal','tipoclientes','numtext'));
    }

    public function destroy(Comanda $comanda){
        $comanda->delete();
        $smssuccess ='La Comanda Se Borro Correctamente';
        notify()->success($smssuccess) or notify()->success($smssuccess, $smssuccess);
        return redirect()->route('admin.comanda.index');
    }

    public function cambio_de_estado($id){
        $comanda = Comanda::findOrFail($id);
        $comanda->estado = 'CANCELADO';
        $comanda->update();
        return redirect()->back()->with('Confirmado');
    }

    public function cambio_estado_factura($id){
        $factura = FacturaVenta::findOrFail($id);
        $factura->estado = 'CANCELADO';
        $factura->update();
        return redirect()->back()->with('Confirmado');
    }

    public function pdf(Comanda $comanda){

        $subtotal = 0;
        $tipoclientes = Cliente::select('*')
        ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
        ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
        ->where('detalle_clientes.tipo_cliente_id', '=', $comanda->tipo_cliente_id)->get();
        $detallecomandas = $comanda->detallecomandas;
        foreach ($detallecomandas as $detallecomanda) {
                $subtotal += $detallecomanda->cantidad *
                $detallecomanda->precio_venta - $detallecomanda->cantidad *
                $detallecomanda->precio_venta * $detallecomanda->descuento / 100;
        }
        //return response()->json($tipoclientes);
        $pdf = PDF::loadView('admin.comanda.pdf', compact('comanda', 'subtotal', 'tipoclientes', 'detallecomandas'))->setOptions(['defaultFont' => 'sans-serif'])->setPaper(array(0,0,320,500), 'portrait');;
        return $pdf->stream('Reporte_de_venta'.$comanda->id.'pdf');
    }

    public function factura(FacturaVenta $factura){
        $comanda = Comanda::get();
        $empresas = Empresa::select('*')->where('id', 1)->firstOrFail();
        $codigoventa = CodigoVenta::select('*')->where('id', 1)->firstOrFail();
        $facturas = FacturaVenta::select('*')
        ->join('comandas', 'comandas.id', '=', 'factura_ventas.comanda_id')
        ->join('clientes', 'clientes.id', '=', 'comandas.cliente_id')
        ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
        ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
        ->where('factura_ventas.id', '=',$factura->id)->get();
        //return response()->json();

        $new = new NumToLetter();
        
        $numtext = $new->numtoletras($factura->comanda->total,'','Bolivianos');

        $pdf = PDF::loadView('admin.comanda.factura', compact('codigoventa','factura','facturas','comanda', 'empresas','numtext',))
        ->setPaper('a4')->setOptions(['tempDir' => public_path(),'chroot'  => public_path()]);
        return $pdf->stream('Reporte_de_venta'.$factura->id.'pdf'); 
    }


    public function ticketfactura(FacturaVenta $factura){
        $comanda = Comanda::get();
        $empresas = Empresa::select('*')->where('id', 1)->firstOrFail();
        $codigoventa = CodigoVenta::select('*')->where('id', 1)->firstOrFail();
        $facturas = FacturaVenta::select('*')
        ->join('comandas', 'comandas.id', '=', 'factura_ventas.comanda_id')
        ->join('clientes', 'clientes.id', '=', 'comandas.cliente_id')
        ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
        ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
        ->where('factura_ventas.id', '=',$factura->id)->get();
        
        //return response()->json();

        $new = new NumToLetter();
        
        $numtext = $new->numtoletras($factura->comanda->total,'','Bolivianos');

        $pdf = PDF::loadView('admin.comanda.ticketfactura', compact('codigoventa','factura','facturas','comanda', 'empresas','numtext',))
        ->setOptions(['defaultFont' => 'sans-serif'])->setPaper(array(0,0,250,650)  , 'portrait');
        return $pdf->stream('Reporte_de_venta'.$factura->id.'pdf'); 
    }


    public function listapedidos(){

        $PedidoPlatos = DB::select('SELECT
        sum(detalle_comandas.cantidad) as cantidad, platos.Nombre_plato as Nombre_plato , platos.id as id  from platos
        inner join detalle_comandas on platos.id=detalle_comandas.plato_id
        inner join comandas on detalle_comandas.comanda_id=comandas.id where DATE(comandas.fecha_venta) = CURDATE()
        group by platos.Nombre_plato, platos.id order by sum(detalle_comandas.cantidad) desc limit 10');

        $PedidoPlatoMesas = DB::select('SELECT
        sum(detalle_comanda_mesas.cantidad) as cantidad, platos.Nombre_plato as Nombre_plato , platos.id as id  from platos
        inner join detalle_comanda_mesas on platos.id=detalle_comanda_mesas.plato_id
        inner join comanda_mesas on detalle_comanda_mesas.comanda_mesa_id=comanda_mesas.id where DATE(comanda_mesas.fecha_venta) = CURDATE()
        group by platos.Nombre_plato, platos.id order by sum(detalle_comanda_mesas.cantidad) desc limit 10');
        return view('admin.comanda.listapedidos',compact('PedidoPlatos','PedidoPlatoMesas'));
    }

    public function autocomplete(Request $request){
        $data = Plato::select("Nombre_plato as value", "Precio_plato","id","Nombre_plato")
                    ->where(function ($query) {$query->whereIn('platos.categoria_id', [2, 3, 4, 5, 6]);})
                    ->where('Nombre_plato', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function autocompletecliente(Request $request){
        $datacliente = Cliente::select("*", DB::raw("CONCAT(Nombre_cliente,' ',Apellidop_cliente) as value"))
        ->where(DB::raw("CONCAT(Nombre_cliente,' ',Apellidop_cliente)"), 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
        return response()->json($datacliente);
    }

    public function autocompletepensionado(Request $request){
        $datapensionado = TipoCliente::select("Nombre_tipoclientes as value","id","Direccion_tipoclientes","tipo")
                                        ->where('tipo', '!=', 'Normal')
                                        ->where('Nombre_tipoclientes', 'LIKE', '%'. $request->get('search'). '%')
                                        ->get();
        return response()->json($datapensionado);
    }

    public function listacomidarapida(){
        $ComidaRapidaPedidos = DB::select('SELECT   
        sum(detalle_comandas.cantidad) as cantidad, platos.Nombre_plato as Nombre_plato , platos.id as id from platos
        inner join detalle_comandas on platos.id=detalle_comandas.plato_id 
        inner join comandas on detalle_comandas.comanda_id=comandas.id where platos.categoria_id = 6 && DATE(comandas.fecha_venta) = CURDATE() 
        group by platos.Nombre_plato, platos.id order by sum(detalle_comandas.cantidad) desc limit 10');

        $ComidaRapidaMesas = DB::select('SELECT   
        sum(detalle_comanda_mesas.cantidad) as cantidad, platos.Nombre_plato as Nombre_plato , platos.id as id  from platos
        inner join detalle_comanda_mesas on platos.id=detalle_comanda_mesas.plato_id 
        inner join comanda_mesas on detalle_comanda_mesas.comanda_mesa_id=comanda_mesas.id where comanda_mesas.fecha_venta = CURDATE()
        group by platos.Nombre_plato, platos.id order by sum(detalle_comanda_mesas.cantidad) desc limit 10');
        //return response()->json($ComidaRapidaPedidos);
        return view('admin.comanda.listacomidarapida',compact('ComidaRapidaPedidos','ComidaRapidaMesas'));
    }

    public function rangehour(Request $request){
        $desde = $request->get('desdehour');
        $hasta = $request->get('hastahour');
        $date = $request->get('fecharange');;
        //2022-11-29 12:01:24
        $from = Carbon::parse($date)->format('Y-m-d') . ' '.$desde;
        $to = Carbon::parse($date)->format('Y-m-d') . ' '.$hasta;
        $data = [];
        $data = Comanda::join('users as u', 'u.id', 'comandas.user_id')
                ->select('comandas.*', 'u.name as user')
                ->whereBetween('comandas.fecha_venta', [$from, $to])
                ->get();
        $tipoclientes = Cliente::select('*')
                ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
                ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
                ->get();
        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();
        
        $pdf = PDF::loadView('admin.comanda.reportehoras',compact('tipoclientes','detallecomandas','data','desde','hasta'));
        return $pdf->stream('reportehoras'.time().'pdf');
       
    }

    public function reporteFull(Request $request){
        $ventaTukomanas = DetalleComanda::select('*')
                    ->join('platos','platos.id','detalle_comandas.plato_id')
                    ->join('categorias','categorias.id','platos.categoria_id')
                    ->where('categorias.id','=',7)
                    ->get();

        //return response()->json($ventaTukomanas);
        return view('admin.comanda.ReporteFull');
    }

    public function TukoRangeFecha(Request $request){
        $desde = $request->get('InicioDate');
        $hasta = $request->get('FinDate');

        $data = [];
 
        $data = Comanda::join('users as u', 'u.id', 'comandas.user_id')
                ->select('comandas.*', 'u.name as user')
                ->join('detalle_comandas','detalle_comandas.comanda_id','comandas.id')
                ->join('platos','platos.id','detalle_comandas.plato_id')
                ->join('categorias','categorias.id','platos.categoria_id')
                ->where('categorias.id','=',7)
                ->whereBetween('comandas.fecha_venta', [$desde, $hasta])
                ->get();
        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();
        
        $pdf = PDF::loadView('admin.comanda.ReporteTukomanasPDF',compact('data','detallecomandas','desde','hasta'));
        return $pdf->stream('TukomanasReportMes'.time().'pdf');
    }

    public function createcafeteria(){

        $clientes = Cliente::get();
        $platos = Plato::select('platos.id','platos.Nombre_plato','platos.Precio_plato',
                                'platos.Caracteristicas_plato','categorias.Nombre_categoria')
                        ->join('categorias','categorias.id','platos.categoria_id')
                        ->where(function ($query) {
                            $query->where('categorias.Nombre_categoria', '=', 'CAFETERIA')
                                  ->orWhere('categorias.Nombre_categoria', '=', 'MASITAS');
                        })
                        ->get();

        $comanda = Comanda::latest('id')->first();
        $categorias = Categoria::get();
        $comandaspdf = Comanda::latest('id')->first();
        $ultimo_registro = Caja::latest('id')->first();
        //return response()->json($platos);
        return view('admin.comanda.createcafeteria', compact('clientes','comanda','platos','categorias','comandaspdf','ultimo_registro'));
        
    }

    public function storecafeteria(Request $request){
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $comanda = Comanda::create($request->all() + [
                'user_id' => Auth::user()->id,
                'fecha_venta' => Carbon::now('America/La_Paz'),
            ]);
            foreach($request->id_plato as $key=>$insert){
                $results[] = array("plato_id" => $request->id_plato[$key],
                                    "cantidad" => $request->cantidad[$key],
                                    "precio_venta" => $request->Precio_plato[$key],
                                    "comentario" => $request->comentario[$key]);
            }
            $comanda->detallecomandas()->createMany($results);

            /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
            $DetalleCajas = DetalleCaja::create([
                'caja_id' => $request->caja_id,
                'codigo_caja_id' => 1,
                'articulo_caja_id' => 5,
                'Articulo_description' => 'CAFETERIA',
                'Ingreso' => $request->total,
                'Egreso' => 0.00,
                'Fecha_registro' => Carbon::now('America/La_Paz'),
            ]);

            $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
            $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
            $resultadohostal = $hostal_ingreso-$hostal_egreso;

            $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
            $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
            $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
            $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
            $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

            $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
            
            $cajas = Caja:: findOrFail($request->caja_id);
            $cajas->caja_hostal_ingreso = $hostal_ingreso;
            $cajas->caja_hostal_egreso = $hostal_egreso;
            $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
            $cajas->caja_restaurante_egreso = $restaurante_egreso;
            $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
            $cajas->total = $totalfinal;
            $cajas->caja_depositos_ingreso = $depositos_ingreso;
            $cajas->save(); 
            /*FIN TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/

            DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ⚡️', 'No Se Pudo Registrar');
            return redirect()->route('admin.comanda.createcafeteria');
        }
            notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente ⚡️', 'Se Registro Correctamente');
            //return response()->json($request->all());
            return redirect()->route('admin.comanda.createcafeteria');
    }

    public function ReportePedidosMes(Request $request){
        $Month = $request->get('monthID');

        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [2, 3, 4])
            ->where(DB::raw("(DATE_FORMAT(comandas.fecha_venta,'%Y-%m'))"), "=", $Month)
            ->groupBy('comandas.id')
            ->get();

        
        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        //return response()->json($data);
        $pdf = PDF::loadView('admin.comanda.ReportePedidosMesPDF', compact('tipoclientes','detallecomandas','data','Month'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReportePedidosDiario(Request $request){
        $InputStart = $request->PedidosDiarioStart;
        $HoraInicio = Carbon::parse($InputStart)->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        $HoraFin = Carbon::parse($InputStart)->setTime(23, 59, 00)->format('Y-m-d H:i:s');

        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [2, 3, 4])
            ->whereBetween('comandas.fecha_venta', [$HoraInicio, $HoraFin])
            ->groupBy('comandas.id')
            ->get();

        
        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        //return response()->json($data);
        $pdf = PDF::loadView('admin.comanda.ReportePedidosDiarioPDF', compact('tipoclientes','detallecomandas','data','InputStart'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReportePedidosRangeFecha(Request $request){
        $desde = $request->get('PedidosInicioDate');
        $hasta = $request->get('PedidosFinalDate');

        $desdeIniciar = Carbon::parse($desde)->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        $hastaConcluir = Carbon::parse($hasta)->setTime(23, 59, 00)->format('Y-m-d H:i:s');
        
        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [2, 3, 4])
            ->whereBetween('comandas.fecha_venta', [$desdeIniciar, $hastaConcluir])
            ->groupBy('comandas.id')
            ->get();

        
        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        //return response()->json($data);
        $pdf = PDF::loadView('admin.comanda.ReportePedidosRangeFechaPDF', compact('tipoclientes','detallecomandas','data','desde','hasta'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReporteTukomanasDiario(Request $request){
        $InputStart = $request->PedidosDiarioStart;
        $HoraInicio = Carbon::parse($InputStart)->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        $HoraFin = Carbon::parse($InputStart)->setTime(23, 59, 00)->format('Y-m-d H:i:s');

        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [7])
            ->whereBetween('comandas.fecha_venta', [$HoraInicio, $HoraFin])
            ->groupBy('comandas.id')
            ->get();
            

        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        //return response()->json($data);
        $pdf = PDF::loadView('admin.comanda.ReporteTukomanasDiarioPDF', compact('tipoclientes','detallecomandas','data','InputStart'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReporteTukomanasMes(Request $request){
        $Month = $request->get('monthID');

        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [7])
            ->where(DB::raw("(DATE_FORMAT(comandas.fecha_venta,'%Y-%m'))"), "=", $Month)
            ->groupBy('comandas.id')
            ->get();

        
        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        //return response()->json($data);
        $pdf = PDF::loadView('admin.comanda.ReporteTukomanasMesPDF', compact('tipoclientes','detallecomandas','data','Month'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReporteTukomanasRangeFecha(Request $request){
        $desde = date('Y-m-d', strtotime($request->PedidosInicioDate));
        $hasta = date('Y-m-d', strtotime($request->PedidosFinalDate));

        $desdeIniciar = Carbon::parse($desde)->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        $hastaConcluir = Carbon::parse($hasta)->setTime(23, 59, 00)->format('Y-m-d H:i:s');
        
        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [7])
            ->whereBetween('comandas.fecha_venta', [$desdeIniciar, $hastaConcluir])
            ->groupBy('comandas.id')
            ->get();

        
        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        $pdf = PDF::loadView('admin.comanda.ReporteTukomanasRangeFechaPDF', compact('tipoclientes','detallecomandas','data','desde','hasta'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReporteCafeteriaDiario(Request $request){
        $InputStart = $request->PedidosDiarioStart;
        $HoraInicio = Carbon::parse($InputStart)->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        $HoraFin = Carbon::parse($InputStart)->setTime(23, 59, 00)->format('Y-m-d H:i:s');

        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [8, 9])
            ->whereBetween('comandas.fecha_venta', [$HoraInicio, $HoraFin])
            ->groupBy('comandas.id')
            ->get();

        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        //return response()->json($data);
        $pdf = PDF::loadView('admin.comanda.ReporteCafeteriaDiarioPDF', compact('tipoclientes','detallecomandas','data','InputStart'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReporteCafeteriaMes(Request $request){
        $Month = $request->get('monthID');

        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [8, 9])
            ->where(DB::raw("(DATE_FORMAT(comandas.fecha_venta,'%Y-%m'))"), "=", $Month)
            ->groupBy('comandas.id')
            ->get();

        
        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        //return response()->json($data);
        $pdf = PDF::loadView('admin.comanda.ReporteCafeteriaMesPDF', compact('tipoclientes','detallecomandas','data','Month'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReporteCafeteriaRangeFecha(Request $request){
        $desde = date('Y-m-d', strtotime($request->PedidosInicioDate));
        $hasta = date('Y-m-d', strtotime($request->PedidosFinalDate));

        $desdeIniciar = Carbon::parse($desde)->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        $hastaConcluir = Carbon::parse($hasta)->setTime(23, 59, 00)->format('Y-m-d H:i:s');
        
        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [8, 9])
            ->whereBetween('comandas.fecha_venta', [$desdeIniciar, $hastaConcluir])
            ->groupBy('comandas.id')
            ->get();

        
        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        $pdf = PDF::loadView('admin.comanda.ReporteCafeteriaRangeFechaPDF', compact('tipoclientes','detallecomandas','data','desde','hasta'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReporteComidaRapidaDiario(Request $request){
        $InputStart = $request->PedidosDiarioStart;
        $HoraInicio = Carbon::parse($InputStart)->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        $HoraFin = Carbon::parse($InputStart)->setTime(23, 59, 00)->format('Y-m-d H:i:s');

        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [6])
            ->whereBetween('comandas.fecha_venta', [$HoraInicio, $HoraFin])
            ->groupBy('comandas.id')
            ->get();

        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        //return response()->json($data);
        $pdf = PDF::loadView('admin.comanda.ReporteComidaRapidaDiarioPDF', compact('tipoclientes','detallecomandas','data','InputStart'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReporteComidaRapidaMes(Request $request){
        $Month = $request->get('monthID');

        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [6])
            ->where(DB::raw("(DATE_FORMAT(comandas.fecha_venta,'%Y-%m'))"), "=", $Month)
            ->groupBy('comandas.id')
            ->get();

        
        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        //return response()->json($data);
        $pdf = PDF::loadView('admin.comanda.ReporteComidaRapidaMesPDF', compact('tipoclientes','detallecomandas','data','Month'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReporteComidaRapidaRangeFecha(Request $request){
        $desde = date('Y-m-d', strtotime($request->PedidosInicioDate));
        $hasta = date('Y-m-d', strtotime($request->PedidosFinalDate));

        $desdeIniciar = Carbon::parse($desde)->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        $hastaConcluir = Carbon::parse($hasta)->setTime(23, 59, 00)->format('Y-m-d H:i:s');
        
        $data = [];
        
        $data = Comanda::select('comandas.*', DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'))
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [6])
            ->whereBetween('comandas.fecha_venta', [$desdeIniciar, $hastaConcluir])
            ->groupBy('comandas.id')
            ->get();

        
        $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();

        $tipoclientes = Cliente::select('*')
            ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
            ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
            ->get();

        $pdf = PDF::loadView('admin.comanda.ReporteComidaRapidaRangeFechaPDF', compact('tipoclientes','detallecomandas','data','desde','hasta'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function ReportePedidosDetalle(Request $request){
        $desde = date('Y-m-d', strtotime($request->PedidosInicioDate));
        $hasta = date('Y-m-d', strtotime($request->PedidosFinalDate));
        
        $desdeIniciar = Carbon::parse($desde)->setTime(0, 0, 0)->format('Y-m-d H:i:s');
        $hastaConcluir = Carbon::parse($hasta)->setTime(23, 59, 59)->format('Y-m-d H:i:s');
        
        $inicio = new DateTime($desdeIniciar);
        $final = new DateTime($hastaConcluir);
       
        $intervalo = new DateInterval('P1D'); // Intervalo de un día
        $periodo = new DatePeriod($inicio, $intervalo, $final);
        
        $days = [];
        
        $totalventas = 0;
        $totalPedidosAux = 0;
        $totalMesasAux = 0;
        $totalTukomanasAux = 0;
        $totalCafeteriaAux = 0;
        $totalComidaRapidaAux = 0;

        foreach ($periodo as $fecha) {
            $date = $fecha->format('Y-m-d');
            $comandas = Comanda::select(
                'comandas.*',
                DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'),
                DB::raw('COUNT(comandas.id) as total_comandas'),
                DB::raw('SUM(detalle_comandas.cantidad) as total_platos')
            )
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [2, 3, 4])
            ->whereDate('fecha_venta', $date)
            ->groupBy('comandas.id')
            ->get();


            $comandamesas = ComandaMesa::select(
                'comanda_mesas.*',
                DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platosmesas'),
                DB::raw('COUNT(comanda_mesas.id) as total_comanda_mesas'),
                DB::raw('SUM(detalle_comanda_mesas.cantidad) as total_plato_mesas')
            )
            ->join('mesas','mesas.id','comanda_mesas.mesa_id')
            ->join('detalle_comanda_mesas', 'detalle_comanda_mesas.comanda_mesa_id', '=', 'comanda_mesas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comanda_mesas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [2, 3, 4, 5])
            ->whereDate('fecha_venta', $date)
            ->groupBy('comanda_mesas.id')
            ->get();

            $TukoManas = Comanda::select(
                'comandas.*',
                DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'),
                DB::raw('COUNT(comandas.id) as total_comandas'),
                DB::raw('SUM(detalle_comandas.cantidad) as total_platos')
            )
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [7, 5])
            ->whereDate('fecha_venta', $date)
            ->groupBy('comandas.id')
            ->havingRaw('SUM(CASE WHEN categorias.id = 7 THEN 1 ELSE 0 END) >= 1 AND SUM(CASE WHEN categorias.id = 5 THEN 1 ELSE 0 END) <= SUM(CASE WHEN categorias.id = 7 THEN 1 ELSE 0 END)')
            ->get();

            $cafeterias = Comanda::select(
                'comandas.*',
                DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'),
                DB::raw('COUNT(comandas.id) as total_comandas'),
                DB::raw('SUM(detalle_comandas.cantidad) as total_platos')
            )
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [8, 9])
            ->whereDate('fecha_venta', $date)
            ->groupBy('comandas.id')
            ->get();

            $comidarapidas = Comanda::select(
                'comandas.*',
                DB::raw('GROUP_CONCAT(platos.Nombre_plato SEPARATOR ", ") as platos'),
                DB::raw('COUNT(comandas.id) as total_comandas'),
                DB::raw('SUM(detalle_comandas.cantidad) as total_platos')
            )
            ->join('detalle_comandas', 'detalle_comandas.comanda_id', '=', 'comandas.id')
            ->join('platos', 'platos.id', '=', 'detalle_comandas.plato_id')
            ->join('categorias', 'categorias.id', '=', 'platos.categoria_id')
            ->whereIn('categorias.id', [6, 5])
            ->whereDate('fecha_venta', $date)
            ->groupBy('comandas.id')
            ->havingRaw('SUM(CASE WHEN categorias.id = 6 THEN 1 ELSE 0 END) >= 1 AND SUM(CASE WHEN categorias.id = 5 THEN 1 ELSE 0 END) <= SUM(CASE WHEN categorias.id = 6 THEN 1 ELSE 0 END)')
            ->get();
            
    
            $comandasDia = count($comandas);
            $comandaMesaDia = count($comandamesas);
            $tukomanasDia = count($TukoManas);
            $cafeteriasDia = count($cafeterias);
            $comidarapidasDia = count($comidarapidas);

            $platosContados = [];
            foreach ($comandas as $comanda) {
                $platos = explode(', ', $comanda->platos);
                foreach ($platos as $plato) {
                    if (array_key_exists($plato, $platosContados)) {
                        $platosContados[$plato]++;
                    } else {
                        $platosContados[$plato] = 1;
                    }
                }
            }
            foreach ($comandamesas as $comandamesa) {
                $platos = explode(', ', $comandamesa->platosmesas);
                foreach ($platos as $plato) {
                    if (array_key_exists($plato, $platosContados)) {
                        $platosContados[$plato]++;
                    } else {
                        $platosContados[$plato] = 1;
                    }
                }
            }
            $platosTukomanas = [];
            foreach ($TukoManas as $TukoMana) {
                $platos = explode(', ', $TukoMana->platos);
                foreach ($platos as $plato) {
                    if (array_key_exists($plato, $platosTukomanas)) {
                        $platosTukomanas[$plato]++;
                    } else {
                        $platosTukomanas[$plato] = 1;
                    }
                }
            }
            $cafeteriaContados= [];
            foreach ($cafeterias as $Cafeteria) {
                $platos = explode(', ', $Cafeteria->platos);
                foreach ($platos as $plato) {
                    if (array_key_exists($plato, $cafeteriaContados)) {
                        $cafeteriaContados[$plato]++;
                    } else {
                        $cafeteriaContados[$plato] = 1;
                    }
                }
            }
            $comidarapidaContados= [];
            foreach ($comidarapidas as $comidarapida) {
                $platos = explode(', ', $comidarapida->platos);
                foreach ($platos as $plato) {
                    if (array_key_exists($plato, $comidarapidaContados)) {
                        $comidarapidaContados[$plato]++;
                    } else {
                        $comidarapidaContados[$plato] = 1;
                    }
                }
            }

            $days[] = [                
                'date' => $date,
                'comandas' => $comandas,
                'comandasDia' => $comandasDia,
                'platosContados' => $platosContados,
                'total' => $comandas->sum('total'),
                'comandamesas' => $comandamesas,
                'comandaMesaDia' => $comandaMesaDia,
                'totalmesas' => $comandamesas->sum('total'),
                'TukoManas' => $TukoManas,
                'platosTukomanas' => $platosTukomanas,
                'tukomanasDia' => $tukomanasDia,
                'totaltukomanas' => $TukoManas->sum('total'),
                'cafeterias' => $cafeterias,
                'cafeteriasDia' => $cafeteriasDia,
                'cafeteriaContados' => $cafeteriaContados,
                'totalcafeterias' => $cafeterias->sum('total'),
                'comidarapidas' => $comidarapidas,
                'comidarapidasDia' => $comidarapidasDia,
                'comidarapidaContados' => $comidarapidaContados,
                'totalcomidarapida' => $comidarapidas->sum('total'),
            ];
            $totalPedidosAux += $comandas->sum('total');
            $totalMesasAux += $comandamesas->sum('total');
            $totalTukomanasAux += $TukoManas->sum('total');
            $totalCafeteriaAux += $cafeterias->sum('total');
            $totalComidaRapidaAux += $comidarapidas->sum('total');

            $totalventas += $comandas->sum('total') + $comandamesas->sum('total') + $TukoManas->sum('total') + $cafeterias->sum('total') + $comidarapidas->sum('total');

        }

        //sacar el total del array para cada cantidad de mes :v
        $totalComandas = 0;
        foreach ($days as $day) {
            $totalComandas += $day['total'];
        }
    
        $clientes = Cliente::get();
        $tipoclientes = TipoCliente::select('tipo_clientes.id as tipo_id','clientes.*')
                            ->join('detalle_clientes','detalle_clientes.tipo_cliente_id','tipo_clientes.id')
                            ->join('clientes','clientes.id','detalle_clientes.cliente_id')
                            ->get();
        $detallecomandas = DetalleComanda::get();
        $mesas = Mesa::get();
        
        $platosContadosTotal = [];

        foreach ($days as $day) {
            // Suma los platos contados del día actual
            foreach ($day['platosContados'] as $plato => $cantidad) {
                if (isset($platosContadosTotal[$plato])) {
                    $platosContadosTotal[$plato] += $cantidad;
                } else {
                    $platosContadosTotal[$plato] = $cantidad;
                }
            }

            // Suma los platos Tuko Manas del día actual
            foreach ($day['platosTukomanas'] as $plato => $cantidad) {
                if (isset($platosContadosTotal[$plato])) {
                    $platosContadosTotal[$plato] += $cantidad;
                } else {
                    $platosContadosTotal[$plato] = $cantidad;
                }
            }

            // Suma las comidas de la cafetería del día actual
            foreach ($day['cafeteriaContados'] as $plato => $cantidad) {
                if (isset($platosContadosTotal[$plato])) {
                    $platosContadosTotal[$plato] += $cantidad;
                } else {
                    $platosContadosTotal[$plato] = $cantidad;
                }
            }

            // Suma las comidas rápidas del día actual
            foreach ($day['comidarapidaContados'] as $plato => $cantidad) {
                if (isset($platosContadosTotal[$plato])) {
                    $platosContadosTotal[$plato] += $cantidad;
                } else {
                    $platosContadosTotal[$plato] = $cantidad;
                }
            }
        }

        arsort($platosContadosTotal);


        //return response()->json($totalventas);

        $pdf = PDF::loadView('admin.comanda.ReportePedidosDetallePDF', compact('totalPedidosAux','totalMesasAux','totalTukomanasAux','totalCafeteriaAux','totalComidaRapidaAux',
                                                                                'totalventas','platosContadosTotal','mesas','totalComandas','detallecomandas','days','clientes',
                                                                                'tipoclientes','desde','hasta'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }           
    
}