<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; 
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Exports\ArticulosExport;
use App\Models\ArticuloDetalle;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\ImageManagerStatic as Image;

class InventarioController extends Controller
{

    public function data(){
        $activos = Articulo::orderBy('id','DESC')->get();
        $activos->transform(function($activo) {
            $activo->photos_articulo = json_decode($activo->photos_articulo);
            return $activo;
        });
        return datatables()->of($activos)->toJson();
    }


    public function index(Request $request){
        $articulos = Articulo::get();
        //return response()->json($articulos);
        return view('admin.inventario_cocina.index',compact('articulos'));
    }

    public function store(Request $request){
        $images = [];

        if (!is_null($request->file('images'))) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filepath = $file->storeAs('images', $filename, 'public');

                // Cargar la imagen utilizando la biblioteca GD
                $image = imagecreatefromstring(file_get_contents($file));
                $width = imagesx($image);
                $height = imagesy($image);
                $newWidth = 800;
                $newHeight = $height * ($newWidth / $width);
                $newImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                // Guardar la imagen procesada en el servidor
                imagejpeg($newImage, public_path('storage/' . $filepath), 80);

                $images[] = urldecode(url('storage/' . $filepath));
            }
        }
        $activo = Articulo::create([
            'Nombre_articulo' => $request->Nombre_articulo,
            'Descripcion_articulo' => $request->Descripcion_articulo,
            'Total_articulo' => $request->cantidad_total,
            'Buen_Estado' => $request->cantidad_total,
            'photos_articulo' => json_encode($images),
        ]);
        return response()->json($activo);
    }
    
    public function edit(Request $request, $id){
        $activos = Articulo::findOrFail($id);
        return response()->json($activos);
    }

    public function updateinventarioarticulo(Request $request, $id){
        $activosupdate = Articulo::findOrFail($id);
        $sumanterior = $activosupdate->Buen_Estado;
        $sumarequest = $request->Edit_Mal_Estado_request + $request->Edit_Daniado_Estado_request;
        $sumatotal = $sumanterior - $sumarequest;
        $datos = 'Datos anterior -> Buen Estado: '.$activosupdate->Buen_Estado.', Mal Estado: '.$activosupdate->Mal_Estado.', Da«Ðados: '.$activosupdate->Daniado_Estado.', TOTAL: '.$activosupdate->Total_articulo;
        if($sumatotal >= 0 ){
            $activosupdate->Nombre_articulo = $request->Edit_Nombre_articulo;
            $activosupdate->Descripcion_articulo = $request->Edit_Descripcion_articulo;
            $activosupdate->Buen_Estado -= $request->Edit_Mal_Estado_request;
            $activosupdate->Buen_Estado -= $request->Edit_Daniado_Estado_request;
            $activosupdate->Mal_Estado += $request->Edit_Mal_Estado_request;
            $activosupdate->Daniado_Estado += $request->Edit_Daniado_Estado_request;
            if (!empty($request->input('imagenes_base64'))) {
                $photos = []; // Inicializar array para guardar URLs de im«¡genes
                foreach ($request->input('imagenes_base64') as $imageData) {
                    $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
                    $imageData = str_replace(' ', '+', $imageData);
                    $imageBytes = base64_decode($imageData);
                    $image = imagecreatefromstring($imageBytes);
                    $filename = time() . '_' . uniqid() . '.jpg'; // Generar un nombre de archivo «ânico
                    imagejpeg($image, public_path('storage/images/' . $filename));
                    $url = url('storage/images/' . $filename);
                    $photos[] = $url; // Agregar la URL de la imagen al array
                }
                $activosupdate->photos_articulo = $photos; // Asignar el array de URLs al atributo
            }
            $activosupdate->save();
            $datosactualizados = 'Datos Nuevo -> Buen Estado: '.$activosupdate->Buen_Estado.', Mal Estado: '.$activosupdate->Mal_Estado.', Da«Ðados: '.$activosupdate->Daniado_Estado.', TOTAL: '.$activosupdate->Total_articulo;
            $articulodetalle = ArticuloDetalle::create([
                'articulo_id' => $activosupdate->id,
                'fecha_actualizado' => Carbon::now('America/La_Paz'),
                'datos_anteriores' => $datos
            ]);
            $articulodetalle = ArticuloDetalle::create([
                'articulo_id' => $activosupdate->id,
                'fecha_actualizado' => Carbon::now('America/La_Paz'),
                'datos_anteriores' => $datosactualizados
            ]);
            return response()->json(['message' => 'Registro actualizado exitosamente.']);
        }else{
            return response()->json(['error' => 'Sobrepasa la cantidad total de activos que tienes en buen estado. No se ha actualizado el registro.']);
        }
    }

    public function updateinventarioarticulototal(Request $request, $id){
        $activosupdate = Articulo:: findOrFail($id);
        $datos = 'Total Anterior: '.$activosupdate->Total_articulo. 'Buen Estado: '.$activosupdate->Buen_Estado;
        $datosactualizados = 'Total Actualizado con un valor de: '.$request->add_cantidad_total_enviar;       
        $activosupdate->Total_articulo += $request->add_cantidad_total_enviar;
        $activosupdate->Buen_Estado += $request->add_cantidad_total_enviar;
        $activosupdate->save();
        $datosnuevos = 'Total Valor nuevo: '.' TotalCantidad: '.$activosupdate->Total_articulo.' BuenEstado: '.$activosupdate->Buen_Estado;
        $articulodetalle = ArticuloDetalle::create([
            'articulo_id' => $activosupdate->id,
            'fecha_actualizado' => Carbon::now('America/La_Paz'),
            'datos_anteriores' => $datosactualizados
        ]);
        $articulodetalle = ArticuloDetalle::create([
            'articulo_id' => $activosupdate->id,
            'fecha_actualizado' => Carbon::now('America/La_Paz'),
            'datos_anteriores' => $datos
        ]); 
        $articulodetalle = ArticuloDetalle::create([
            'articulo_id' => $activosupdate->id,
            'fecha_actualizado' => Carbon::now('America/La_Paz'),
            'datos_anteriores' => $datosnuevos
        ]);               
        return response()->json($activosupdate); 
    }
    
    public function destroyinventarioarticulo(Articulo $articulo){
        $articulo->delete();
        $smssuccess ='Se Borro Correctamente correctamente';
        notify()->success($smssuccess) or notify()->success($smssuccess, $smssuccess);
        return redirect()->route('admin.inventario_cocina.index');
    }
    
    public function cambio_de_estado($id){
        $articulo = Articulo::findOrFail($id);
        $articulo->estado = 'DADO DE BAJA';
        $articulo->update();
        return redirect()->back();
    }

    public function Articulosexcel(){
        return Excel::download(new ArticulosExport, Now().'_Articulos.xlsx');
    }

    public function Articulospdf(){
        $articulosArray = Articulo::all();    
        $pdf = PDF::loadView('admin.inventario_cocina.pdf_articulos', compact('articulosArray'))->setPaper('A4', 'landscape');
        return $pdf->stream(Now().'_Articulos'.'.pdf');
    }
    
}
