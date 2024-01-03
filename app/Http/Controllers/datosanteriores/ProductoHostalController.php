<?php

namespace App\Http\Controllers;

use App\Models\ProductoHostal;
use App\Models\UpdateStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gregwar\Captcha\CaptchaBuilder;
use Carbon\Carbon;

class ProductoHostalController extends Controller
{

    public function index(){
        
        $productos = ProductoHostal::get();
        $updateproductos = UpdateStock::get();
        return view('hostal.productos.index',compact('productos','updateproductos'));
    }

    public function updatestock(Request $request, $id){
        $data = request()->validate([
            'math_captcha' => 'required|in:'.session('math_captcha'),
        ]);

        $datosupdatestock = UpdateStock::create([
            'producto_id' => $id,
            'ActualizarStock' => Carbon::now('America/La_Paz'),
        ]);

        $DatosProduct = ProductoHostal::findOrFail($id); 
        $DatosProduct->Stock_producto += $request->stock;
        $DatosProduct->save();
        
        notify()->success('Acabas De Aumentar El Stock DeL Producto') or notify()->success('Acabas De Aumentar El Stock DeL Producto');
        return redirect()->back()->with('success', 'Product stock updated successfully!');
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            //return response()->json($request->Nombre_producto);
            
            $datosProduct = ProductoHostal::create([
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
}
