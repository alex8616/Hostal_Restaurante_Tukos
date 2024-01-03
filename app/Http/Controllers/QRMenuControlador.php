<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRMenuControlador extends Controller
{
    public function menubar(){
        return view('admin.QRMenu.menubar');
    }

    public function menurestaurante(){
        return view('admin.QRMenu.menurestaurante');
    }

    public function nuestrositio(){
        return view('admin.QRMenu.NuestroSitio');
    }
    
    public function GenerarCodigoQR(){
        $data = 'https://tukos.sdmlabo.com/nuestrositio';

        // Generar el c¨®digo QR con el logotipo
        $qrCodeWithLogo = QrCode::format('png')->size(500)
            ->color(0, 18, 83)
            ->eyeColor(0, 239, 91, 12, 0, 18, 83)
            ->eyeColor(1, 239, 91, 12, 0, 18, 83)
            ->eyeColor(2, 239, 91, 12, 0, 18, 83)
            ->errorCorrection('H') // Puedes probar con 'L', 'M', 'Q' o 'H'
            ->merge(public_path('/img/logocontorno3.png'), 0.5, true)
            ->generate($data);

        // Pasar la URL de destino y el c¨®digo QR con logotipo a la vista Blade
        return view('admin.QRMenu.GeneradorQR', compact('data', 'qrCodeWithLogo'));
    }
}
