<?php

namespace App\Http\Controllers;

use App\Models\ProductoHostal;
use App\Models\UpdateStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gregwar\Captcha\CaptchaBuilder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\DetalleCaja;
use App\Models\Caja;
use App\Models\DetalleProducto;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductoHostalController extends Controller
{

    public function index(){
        
        $productos = ProductoHostal::get();
        $updateproductos = UpdateStock::get();
        $ultimo_registro = Caja::latest('id')->first();
        return view('hostal.productos.index',compact('productos','updateproductos','ultimo_registro'));
    }

    public function updatestock(Request $request, $id){
        $data = request()->validate([
            'math_captcha' => 'required|in:'.session('math_captcha'),
        ]);

        $producto = ProductoHostal::findOrFail($id);
        $datosupdatestock = UpdateStock::create([
            'producto_id' => $id,
            'ActualizarStock' => Carbon::now('America/La_Paz'),
            'aumento' => $request->stock,
        ]); 

        $DatosProduct = ProductoHostal::findOrFail($id); 
        $DatosProduct->Stock_producto += $request->stock;
        $DatosProduct->save();
        
        notify()->success('Acabas De Aumentar El Stock DeL Producto') or notify()->success('Acabas De Aumentar El Stock DeL Producto');
        return redirect()->back()->with('success', 'Product stock updated successfully!');
    }

    public function vender(Request $request, $id){
        $user = Auth::user();
        $productos = ProductoHostal::findOrFail($id);

        $detalleproducto = DetalleProducto::create([
            'hospedaje_habitacion_id' => NULL,
            'reserva_habitacion_id' => NULL,
            'user_id' => $user->id,
            'producto_id' => $id,
            'cantidad' => $request->cantidad_venta,
            'Precio_venta' => $request->precio_venta,
            'Tipo_pagado' => 'Pagado',
            'anteriorventa' => $productos->Stock_producto,
            'fecha_registro' => Carbon::now('America/La_Paz'),
        ]);

        $priceventa = $request->precio_venta * $request->cantidad_venta;
        $productos->Stock_producto -= $request->cantidad_venta;
        $productos->save();
        
        /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
        $DetalleCajas = DetalleCaja::create([
            'caja_id' => $request->caja_id,
            'codigo_caja_id' => 2,
            'articulo_caja_id' => 64,
            'Articulo_description' => 'vendido '.$productos->Nombre_producto.' cantidad de '.$request->cantidad_venta.' a precio de unidad '.$request->precio_venta,
            'Ingreso' => $priceventa,
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
        
        notify()->success('Acabas De Aumentar El Stock DeL Producto') or notify()->success('Acabas De Aumentar El Stock DeL Producto');
        return redirect()->back()->with('success', 'Product stock updated successfully!');
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            //return response()->json($request->Nombre_producto);
            
            $datosProduct = ProductoHostal::create([
                'Categoria' => $request->Categoria_producto,
                'Nombre_producto' => $request->Nombre_producto,
                'Detalle_producto' => $request->Detalle_producto,
                'Precio_producto' => $request->Precio_producto,
                'Stock_producto' => $request->Stock_producto,
                'FechaRegistro_producto' => $request->FechaRegistro_producto,
            ]);
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar, No Se Pudo Registrar El Producto') or notify()->error('No Se Pudo Registrar⚡️', 'Articulo NO Registrado');
            return redirect()->route('hostal.producto.index');
        }
            notify()->success('Se registró correctamente') or notify()->success('Se registró correctamente ⚡️', 'Articulo Registrado Correctamente');
            return redirect()->route('hostal.producto.index');
    }

    public function mathCaptchaImage(){
        // Generate the math operation
        $operations = [
            "+", "-", "*", "/"
        ];
        $firstNumber = rand(1, 10);
        $secondNumber = rand(1, 10);
        $operation = $operations[rand(0,3)];
        $mathCaptcha = eval("return $firstNumber $operation $secondNumber;");
        session(['math_captcha' => $mathCaptcha]);
        $mathCaptchaText = "$firstNumber $operation $secondNumber";

        // Create the captcha image
        $builder = new CaptchaBuilder($mathCaptchaText);
        $builder->setBackgroundColor(255, 255, 255);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        $builder->build();

        // Store the image data in session
        session(['math_captcha_image' => $builder->inline()]);
        return response($builder->get())->header('Content-Type', 'image/jpeg');
    }

    public function getMathCaptchaImage(){
        return response(session('math_captcha_image'))->header('Content-Type', 'image/jpeg');
    }

    public function validateMathCaptcha(Request $request){
        $mathCaptcha = $request->input('math_captcha');
        if ($mathCaptcha == session('math_captcha')) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false]);
        }
    }
    
    public function kardexpdf(Request $request){
        $productos = ProductoHostal::with(['actualizarstocks', 'detalleproductos'])->get();

        //return response()->json($productos);
        $pdf = PDF::loadView('hostal.productos.kardexpdf',compact('productos'))
                ->setPaper('A4', 'portrait');
        return $pdf->stream('Planilla'.time().'pdf');
    }
}
